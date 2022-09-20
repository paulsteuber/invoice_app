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
            <tbody>
                <invoice-single-position-component @posData="posData"></invoice-single-position-component>
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
                positions: {
                    
                }
            }
        },
        methods:{
            posData: function(val){
               
            },
            addPosition: function(){

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>