<template>
    <tr>
        <th scope="row">
           {{id}}
        </th>
        <td class="add_description">
            <input type="text" class="form-control" v-model="posData.description">
        </td>
        <td>
            <span class="position_counter font-weight-bold">{{posData.quantity}}</span>
            <a class="position_countUp btn btn-primary " @click="countUp(true)">+</a>
            <a class="position_countDown btn btn-outline-primary" @click="countUp(false)">-</a>
            <a class="position_remove btn btn-outline-primary" @click="removePos()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg>
            </a>
            <input class="form-control" type="hidden"  v-model="posData.quantity">
        </td>
        <td><input class="form-control netto" type="text" v-model="posData.netto"></td>
        <td><input class="form-control mwst" type="text" v-model="posData.mwst_rate"></td>
        <th class="text-right">{{posData.netto_total}}€</th>
    </tr>
</template>

<script>
    export default {
        name: "InvoiceSinglePositionComponent",
        props:[
            "inputData",
            "id"
        ],
        data(){
            return {
                posData: {
                    id: this.id,
                    description: "",
                    quantity: 1,
                    netto: 0,
                    mwst_rate: 19,
                    brutto_total: 0,
                    netto_total: 0,
                    mwst_total: 0,
                }
                
            }
        },
        watch:{
            posData: {
                handler(newValue, oldValue) {
                    this.validateToNumber();
                    this.calculate();
                    //send data to parent
                    this.$emit('posData', this.posData);
                },
                deep: true
            }
        },
        methods:{
            countUp: function(up){
                if(up){
                    this.posData.quantity++;
                } else {
                    if(this.posData.quantity > 1) this.posData.quantity--;
                }
            },
            validateToNumber: function(){
                this.posData.netto = isNaN(this.toFloat(this.posData.netto)) ? 0 : this.posData.netto;
                this.posData.mwst_rate = isNaN(this.posData.mwst_rate) ? 19 : this.posData.mwst_rate;
            },
            validateMwst: function(){
                const netto = this.toFloat(this.posData.netto);
                const mwst = this.toFloat(this.posData.mwst) / 100;
                const brutto = this.toFloat(this.posData.brutto);
                
                return netto * (1+mwst) === brutto; 
            },
            calculate: function(){
                const netto = this.toFloat(this.posData.netto);
                const mwst = this.toFloat(this.posData.mwst) / 100;
                const brutto = this.toFloat(this.posData.brutto);

                this.posData.netto_total = this.printCurrency(netto * this.posData.quantity);
                this.posData.mwst_total = this.printCurrency(netto * mwst);
                this.posData.brutto_total = this.printCurrency(this.posData.netto_total + this.posData.mwst_total);
                //this.posData.netto =this.printCurrency(netto);
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
                this.$parent.removePosition(this.id);
            }
        },
        updated (){
            alert("UPDATED");
        },
        mounted() {
            alert("MOUNTED");
           this.posData.id = this.id;
           this.posData.description = this.inputData.description;
           this.posData.quantity = this.inputData.quantity;
           this.posData.netto = this.inputData.netto;
           this.posData.mwst_rate = this.inputData.mwst_rate;
        }

    }
</script>