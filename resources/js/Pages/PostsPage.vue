<script setup>
import Layout from "@/Shared/Layout.vue";
import MyInput from "@/Shared/MyInput.vue";
import MyButton from "@/Shared/MyButton.vue";
import {useForm, Link} from "@inertiajs/vue3";

defineProps({
    posts: Array,
})

const form = useForm({
    title: null,
    content: null,
    user_id: null
})

function addPostInDatabase(user){
    form.user_id = user.id;
    form.post('/posts/create')
}

function deletePostFromDatabase(id){
    if(!confirm('Вы уверенны что хотите удалить этот пост?')) return

    const deleteId = useForm({
        id: id
    })

    deleteId.delete(`/posts/${id}/delete`)
}
</script>

<template>
    <layout>
        <header class="main-header">
            <h1>{{ $page.props.user?.name ?? 'Вы не авторизованны' }}</h1>
            <Link v-if="$page.props.user" href="/logout">Выйти</Link>
            <div v-else style="display: flex; gap: 25px">
                <Link href="/login">Войти</Link>
                <Link href="/registration">Зарегистрироваться</Link>
            </div>
        </header>
        <div v-if="$page.props.user">
            <h2>Добавить пост</h2>
            <form class="add-post" @submit.prevent="addPostInDatabase($page.props.user)">
                <my-input v-model:value="form.title" placeholder="Название"/>
                <p v-if="form.errors.title" class="error">{{ form.errors.title }}</p>

                <my-input v-model:value="form.content" placeholder="Контент"/>
                <p v-if="form.errors.content" class="error">{{ form.errors.content }}</p>

                <my-button style="align-self: end">Добавить</my-button>
            </form>
        </div>
        <h2>Посты</h2>
        <div v-for="post in posts" class="post" :key="post.id">
            <div class="post-container">
                <p class="title">{{ post.title }}</p>
                <p class="content">{{ post.content }}</p>
                <p>Автор: {{ post.user.name }}</p>
            </div>
            <my-button v-if="$page.props.user?.id === post.user.id" @click="deletePostFromDatabase(post.id)" class="delete-button">Удалить</my-button>
        </div>
    </layout>
</template>

<style scoped lang="scss">
.main-header{
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.add-post{
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.post{
    border-radius: 15px;
    border: 3px solid #5583ff;
    margin-top: 15px;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-self: center;

    .delete-button{
        background-color: #ef4444;

        &:hover{
            background-color: #c73838;
        }
    }

    p{
        margin: 0;
    }

    .title{
        font-size: 24px;
        color: #5583ff;
    }
}

.error{
    color: red;
    margin: 0;
}
</style>
