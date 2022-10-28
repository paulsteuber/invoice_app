<template>
    <div class="filter">
        <div class="filter-years">
            <div class="btn-group" role="group" aria-label="Filtern nach Zeit">
                <button type="button" class="btn btn-sm btn-primary">All Time</button>
                <button type="button" class="btn btn-sm btn-secondary">2022</button>
                <button type="button" class="btn btn-sm btn-secondary">2021</button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapMutations } from 'vuex';
    export default {
        computed: {
            ...mapGetters([]),
        },
        methods:{
            ...mapMutations([]),
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
