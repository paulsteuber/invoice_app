<template>
    <tr>
        <th scope="row">
           <!-- <a type="button" class="remove-pos ml-4" @click="deletePosition(index)">                
            </a> -->
        </th>
        <td class="add_description">
            <input type="text" class="form-control" v-model="posData.description">
        </td>
        <td>
            <span class="position_counter font-weight-bold">{{posData.quantity}}</span>
            <a class="position_countUp btn btn-primary " @click="countUp(true)">+</a>
            <a class="position_countDown btn btn-outline-primary" @click="countUp(false)">-</a>
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
            "data",
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
                if(!up){
                    if(this.posData.quantity > 1) this.posData.quantity--;
                }
                if(up){
                    this.posData.quantity++;
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
                
            }
        },

        mounted() {
           this.posData.id = this.id;
           this.posData.description = this.data.description;
           this.posData.quantity = this.data.quantity;
           this.posData.netto = this.data.netto;
           this.posData.mwst_rate = this.data.mwst;
        }

    }
</script>