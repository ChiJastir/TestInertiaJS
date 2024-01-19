<script>
export default {
    name: "MyButton"
}
</script>

<template>
    <button>
        <slot/>
    </button>
</template>

<style scoped lang="scss">
    button{
        background-color: #5583ff;
        font-size: 24px;
        border: none;
        outline: none;
        padding: 15px;
        border-radius: 15px;
        color: white;

        &:hover{
            background-color: #305fde;
        }
    }
</style>
