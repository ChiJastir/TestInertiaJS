<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import MyInput from "@/Shared/MyInput.vue";
import Layout from "@/Shared/Layout.vue";
import MyButton from "@/Shared/MyButton.vue";

const form = useForm({
    name: null,
    email: null,
    password: null,
})

function createUser(){
    form.post('/registration')
}
</script>

<template>
    <Layout>
        <h1>Регистрация</h1>
        <form class="registration-form" @submit.prevent="createUser">
            <my-input placeholder="Имя пользователя" v-model:value="form.name"/>
            <my-input placeholder="Почта" v-model:value="form.email"/>
            <my-input placeholder="Пороль" v-model:value="form.password"/>
            <my-button>Создать</my-button>
        </form>
        <p>Есть аккаунт? <Link href="/login">Войти</Link></p>
    </Layout>
</template>

<style scoped lang="scss">
.registration-form{
    display: flex;
    flex-direction: column;
    gap: 15px;
}
</style>
