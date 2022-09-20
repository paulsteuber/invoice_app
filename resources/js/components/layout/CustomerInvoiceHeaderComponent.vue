<template>
     <div class="main-content-header d-flex justify-content-between align-items-center">
        <h1 class="page-title h6">{{headerTitle}}</h1>
        <a type="button" class="h3 btn btn-primary" :href="addButtonUrl">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
                {{ addButton }}</a>
        </div>
</template>

<script>
    export default {
        props: [
            "headerTitle",
            "addButton",
            "addButtonUrl",
        ],
        methods: {

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style>
    .main-content-header{
        margin-bottom: 1.25rem;
    }
</style>