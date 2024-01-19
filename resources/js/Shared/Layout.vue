<script>
export default {
    name: "Layout"
}
</script>

<template>
    <div class="container">
        <slot/>
    </div>
</template>

<style scoped>
    .container{
        max-width: 1200px;
        margin: auto;
        font-family: sans-serif;
    }
</style>
