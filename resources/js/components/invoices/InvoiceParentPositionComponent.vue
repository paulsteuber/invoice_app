<template>
    <div class="new col-sm-12">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Beschreibung</th>
                <th scope="col">Anzahl</th>
                <th scope="col">Netto</th>
                <th scope="col">MwSt.%</th>
                <th scope="col" class="text-right">Netto Total</th>
                </tr>
            </thead>
            <tbody v-for="(position, index) in allPositions" :key="position.id">
                <invoice-single-position-component :inputData="position" :id="index"></invoice-single-position-component>
                   
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <a class="add_position btn btn-primary"  @click="addPosition()">Weitere Position hinzufügen</a>
        </div>
    </div>
</template>

<script>   
    import { mapGetters, mapMutations } from 'vuex';
    export default {
        computed: {
            ...mapGetters(['allPositions', 'defaultPosition']),
        },
        data() {
        },
        methods:{
            ...mapMutations(['addPosition']),
        },
        mounted(){
            this.addPosition();
        }
        
    }
</script>