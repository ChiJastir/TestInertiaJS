<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use function Termwind\render;

class UserController extends Controller
{
    public function createUserOld(Request $request)
    {
        $password = $request['password'];
        $request['password'] = bcrypt($request['password']);

        // лучше всегда использовать реквесты для этого) перепишу этот метод ниже
        $user = User::query()->insert(
            $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users')],
                'password' => ['required', 'string', 'min:5']
            ])
        );

        if($user){
            $request['password'] = $password;

            // это можно сделать с использованием Auth::login($user)
            auth()->attempt($request->validate([
                'email' => ['string', 'required', 'email'],
                'password' => ['required', 'string']
            ]));

            return redirect()->route('post.page');
        }

        // вот здесь ошибка. Что если пользователя не будет? Функция ничего не возвращает, нужно хотя бы еррор кинуть
    }



    public function createUser(CreateUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        if(!$user) // кидаем exception (один из вариантов реализации)
            throw new \Exception('Error on registering user. Please, try later');

        Auth::login($user);

        return redirect()->route('post.page');
    }


}
