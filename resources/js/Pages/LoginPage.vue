<script setup>
import {useForm} from "@inertiajs/vue3";
import MyInput from "@/Shared/MyInput.vue";
import Layout from "@/Shared/Layout.vue";
import MyButton from "@/Shared/MyButton.vue";
import {Link} from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
})

function login(){
    form.post('/login')
}
</script>

<template>
    <Layout>
        <h1>Вход</h1>
        <form class="login-form" @submit.prevent="login">
            <my-input placeholder="Почта" v-model:value="form.email"/>
            <p v-if="form.errors.email" class="error">{{ form.errors.email }}</p>

            <my-input placeholder="Пороль" v-model:value="form.password"/>
            <p v-if="form.errors.password" class="error">{{ form.errors.password }}</p>

            <my-button>Войти</my-button>
        </form>
        <p>Нет аккаута? <Link href="/registration">Зарегистрироваться</Link></p>
    </Layout>
</template>

<style scoped lang="scss">
.login-form{
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.error{
    color: red;
    margin: 0;
}
</style>
