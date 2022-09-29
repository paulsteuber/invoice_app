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
            <tbody v-for="(position, index) in positions">
                    <invoice-single-position-component @posData="posData" :data="position" :id="index"></invoice-single-position-component>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <a class="add_position btn btn-primary"  @click="addPosition()">Weitere Position hinzufügen</a>
        </div>
    </div>
</template>

<script>    
    export default {
        
        data() {
            return {
                defaultPosition:{
                    description: "Test",
                    quantity: 1,
                    netto: 0,
                    mwst: 19,
                },
                positions: []
            }
        },
        methods:{
            posData: function(val){
               
            },
            addPosition: function(){
                this.positions.push(this.defaultPosition);
            }
        },
        mounted() {
            this.positions.push(this.defaultPosition);
            console.table(this.positions.first);
        }
    }
</script>