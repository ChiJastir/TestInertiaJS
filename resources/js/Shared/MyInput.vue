<script>
export default {
    name: "MyInput",
    props: {
        placeholder: String,
        value: String,
    },
    methods: {
        updateInput(event) {
            this.$emit('update:value', event.target.value)
        }
    }
}
</script>

<template>
<div class="input">
    <input :value="value" @input="updateInput" :placeholder="placeholder"/>
</div>
</template>

<style scoped lang="scss">
.input{
    padding: 10px;
    border: 3px solid #5583ff;
    border-radius: 15px;
    input{
        width: 100%;
        display: inline-block;
        border: none;
        outline: none;
        font-size: 24px;
    }
}
</style>
