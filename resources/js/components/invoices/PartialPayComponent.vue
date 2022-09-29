
<template>
    <div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" v-model="partial_pay" :value="partial_pay" id="invoice_partial_pay" name="invoice_partial_pay">
            <label class="custom-control-label" for="invoice_partial_pay">Rechnung mit Teilvorauszahlung</label>
        </div> 
        <div class="row partial_pay_container">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="invoice_partial_pay_date" class=" col-form-label">Teilzahlung Zahlungsziel</label>
                        <div class="">
                        <input id="invoice_partial_pay_date" type="date" class="form-control" name="invoice_partial_pay_date" :value="partial_pay_date"  :required="!is_partial_pay_active" :disabled="is_partial_pay_active">
                        </div>
                    </div>
                        
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="invoice_partial_pay_sum" class=" col-form-label">Teilzahlung Betrag</label>
                        <div class="">
                        <input id="invoice_partial_pay_sum" type="text" class="form-control text-right" name="invoice_partial_pay_sum" placeholder="0,00€" :value="partial_pay_sum" :required="!is_partial_pay_active" :disabled="is_partial_pay_active">
                        </div>
                        
                    </div> 
                </div>
            </div>
        </div>

    </div>
</template>
<script>

export default {
    props: [
        "oldInvoice"
    ],
    data () {
        return {
            old_invoice_copy: null, 
            partial_pay: 0,
            partial_pay_date : null,
            partial_pay_sum: 0,
        }
    },
    created: function(){
        this.old_invoice_copy = JSON.parse(this.oldInvoice);
        this.partial_pay_date = this.old_invoice_copy.invoice_partial_pay_date;
        this.partial_pay = this.old_invoice_copy.invoice_partial_pay;
        this.partial_pay_sum = this.old_invoice_copy.invoice_partial_pay_sum;
        console.log(this.old_invoice_copy)
    },
    mounted() {
    },
    methods: {

    },
    computed: {
        is_partial_pay_active: function(){
            return !this.partial_pay;
        }
    }
}
</script>