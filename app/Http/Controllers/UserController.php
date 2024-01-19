<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use function Termwind\render;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $password = $request['password'];
        $request['password'] = bcrypt($request['password']);

        $user = User::query()->insert(
            $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users')],
                'password' => ['required', 'string', 'min:5']
            ])
        );

        if($user){
            $request['password'] = $password;

            auth()->attempt($request->validate([
                'email' => ['string', 'required', 'email'],
                'password' => ['required', 'string']
            ]));

            return redirect()->route('post.page');
        }
    }
}
