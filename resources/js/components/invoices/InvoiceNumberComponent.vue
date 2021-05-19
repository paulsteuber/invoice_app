<template>
    <div class="col-md-4">
        <div class="row">
           <label for="name" class="col-md-12 col-form-label">Rechnungsnummer</label>
           <div class="col-lg-6">
            <h3 class="text-right">{{nextInvoiceNumber}}</h3>
           </div>
           <div class="col-lg-6 d-flex justify-content-center">
                <a class="btn btn-primary " v-on:click="countIt(true)">+</a>
                <a class="btn btn-outline-primary ml-1" v-on:click="countIt(false)">-</a>
           </div>
           <input type="hidden" id="invoice_number" name="invoice_number" :value="nextInvoiceNumber">
        </div>
    </div>

</template>
<script>

export default {
    props:[
        'nextInvoiceNumber'
    ],
    data () {
        return {
        }
    },
        mounted() {
            /*
            axios
                .get('/json/auth/invoices')
                .then(response => {
                    this.customers = response.data;
                })
            */
        },
        methods:{
            countIt: function(up){
                if(this.nextInvoiceNumber == 0 && !up){
                    console.log("Negative Rechnungsnummer ist nicht erlaubt");
                } else{
                    console.log(this.nextInvoiceNumber);
                     up ? this.nextInvoiceNumber++ : this.nextInvoiceNumber--;
                }
            }
        },
        computed:{
            
        }
}
</script>