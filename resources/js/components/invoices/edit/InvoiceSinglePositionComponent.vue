<template>
    <tr>
        <th scope="row">
           {{inputData.id+1}}
        </th>
        <td class="add_description">
            <input type="text" class="form-control" v-model="inputData.description" placeholder="Bezeichnung">
        </td>
        <td>
            <span class="position_counter font-weight-bold">{{inputData.quantity}}</span>
            <a class="position_countUp btn btn-primary mr-1" @click="countUp(true)">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path></svg>
            </a>
            <a class="position_countDown btn btn-outline-primary mr-1" @click="countUp(false)">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                </svg>
            </a>
            <a class="position_copy btn btn-outline-primary mr-1" @click="copyPos()" title="Kopieren">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2" viewBox="0 0 16 16">
                    <path d="M3.5 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5H12a.5.5 0 0 1 0-1h.5A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1H4a.5.5 0 0 1 0 1h-.5Z"/>
                    <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                </svg>
            </a>
            <a class="position_remove btn btn-outline-primary" @click="removePos()" title="Löschen">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg>
            </a>
            <input class="form-control" type="hidden"  v-model="inputData.quantity">
        </td>
        <td><input class="form-control netto" type="text" v-model="inputData.netto"></td>
        <td><input class="form-control mwst" type="text" v-model="inputData.mwst_rate"></td>
        <th class="text-right">{{inputData.netto_total}}€</th>
    </tr>
</template>

<script>
import { toFloat, printCurrency } from '../../../helpers';
import { mapGetters, mapMutations } from 'vuex';

    export default {
        name: "InvoiceSinglePositionComponent",
        computed: {
            ...mapGetters(['getPosition']),
        },
        props:[
            "inputData",
        ],        
        watch:{
            inputData: {
                handler(newValue, oldValue) {
                    this.validateToNumber();
                    this.calculate();
                    //send data to parent
                    //this.$emit('inputData', this.inputData);
                },
                deep: true
            }
        },
        methods:{
            ...mapMutations(['removePosition', 'updatePosition', 'copyPosition']),


            countUp: function(up){
                if(up){
                    this.inputData.quantity++;
                } else {
                    if(this.inputData.quantity > 1) this.inputData.quantity--;
                }
            },
            validateToNumber: function(){
                this.inputData.netto = isNaN(toFloat(this.inputData.netto)) ? 0 : this.inputData.netto;
                this.inputData.mwst_rate = isNaN(this.inputData.mwst_rate) ? 19 : this.inputData.mwst_rate;
            },
            validateMwst: function(){
                const netto = toFloat(this.inputData.netto);
                const mwst = toFloat(this.inputData.mwst) / 100;
                const brutto = toFloat(this.inputData.brutto);
                
                return netto * (1+mwst) === brutto; 
            },
            calculate: function(){
                const netto = toFloat(this.inputData.netto);
                const mwst = toFloat(this.inputData.mwst_rate) / 100;

                const netto_total = netto * this.inputData.quantity;
                const mwst_total = netto_total * mwst;

                this.inputData.netto_total = printCurrency(netto_total);
                this.inputData.brutto_total = printCurrency(netto_total + mwst_total);
                this.inputData.mwst_total = printCurrency(mwst_total);
            },
           
            removePos: function(){
                this.removePosition(this.inputData.id);
            },
            copyPos: function(){
                this.copyPosition(this.inputData);
            }
        },
        updated(){
            console.log("updated position", this.inputData);
            this.updatePosition(this.inputData);
        },
        mounted() {
        },

    }
</script>