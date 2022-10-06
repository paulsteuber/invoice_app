<template>
    <tr>
        <th scope="row">
           {{id}}
        </th>
        <td class="add_description">
            <input type="text" class="form-control" v-model="inputData.description">
        </td>
        <td>
            <span class="position_counter font-weight-bold">{{inputData.quantity}}</span>
            <a class="position_countUp btn btn-primary " @click="countUp(true)">+</a>
            <a class="position_countDown btn btn-outline-primary" @click="countUp(false)">-</a>
            <a class="position_remove btn btn-outline-primary" @click="removePos()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
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
 import { mapGetters, mapMutations } from 'vuex';

    export default {
        name: "InvoiceSinglePositionComponent",
        computed: {
            ...mapGetters(['getPosition']),
        },
        props:[
            "inputData",
            "id"
        ],
        data(){
        },
        
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
            ...mapMutations(['removePosition', 'updatePosition']),


            countUp: function(up){
                if(up){
                    this.inputData.quantity++;
                } else {
                    if(this.inputData.quantity > 1) this.inputData.quantity--;
                }
            },
            validateToNumber: function(){
                this.inputData.netto = isNaN(this.toFloat(this.inputData.netto)) ? 0 : this.inputData.netto;
                this.inputData.mwst_rate = isNaN(this.inputData.mwst_rate) ? 19 : this.inputData.mwst_rate;
            },
            validateMwst: function(){
                const netto = this.toFloat(this.inputData.netto);
                const mwst = this.toFloat(this.inputData.mwst) / 100;
                const brutto = this.toFloat(this.inputData.brutto);
                
                return netto * (1+mwst) === brutto; 
            },
            calculate: function(){
                const netto = this.toFloat(this.inputData.netto);
                const mwst = this.toFloat(this.inputData.mwst) / 100;
                const brutto = this.toFloat(this.inputData.brutto);

                this.inputData.netto_total = this.printCurrency(netto * this.inputData.quantity);
                this.inputData.mwst_total = this.printCurrency(netto * mwst);
                this.inputData.brutto_total = this.printCurrency(this.inputData.netto_total + this.inputData.mwst_total);
                //this.inputData.netto =this.printCurrency(netto);
            },
            printCurrency: function(num){
                return new Intl.NumberFormat('de-DE', { minimumFractionDigits: 2 }).format(num);
            },
            toFloat: function(val){
                if(val !== undefined){
                    return parseFloat(String(val).replace(/,/, '.'));
                }
                
            },
            removePos: function(){
                this.removePosition(this.id);
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