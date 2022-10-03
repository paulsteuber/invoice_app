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
                    <invoice-single-position-component @posData="posData" :inputData="position" :id="index"></invoice-single-position-component>
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
                defaultPosition: {
                    id: 0,
                    description: "TEST",
                    quantity: 1,
                    netto: 0,
                    mwst_rate: 19,
                    brutto_total: 0,
                    netto_total: 0,
                    mwst_total: 0,
                },
                positions: [],
                
            }
        },
        methods:{
            posData: function(updatedPosition){
               this.positions[updatedPosition.id] = updatedPosition;
            },
            addPosition: function(){
                this.positions.push(this.defaultPosition);
                let arr = [{id:"A"},{id:"B"},{id:"C"}];
                arr.splice(1, 1)
                console.log("ARR", arr);
            },
            removePosition(id){
                console.log("ID", id);
                console.log("BEFORE", this.positions)
                console.log("BEFORE POS DESC", this.positions[id].description)
                this.positions.splice(id, 1)
                console.log("final",this.positions);
            }
        },
        mounted() {
            let newDefaultPosition = this.defaultPosition;
            newDefaultPosition.id = this.positions.length;
           this.positions.push(newDefaultPosition);
        }
    }
</script>