<template>
    <div class="datepicker pay_date">
        <input id="invoice_pay_date" type="date" name="invoice_pay_date" :classList="inputClasses" :placeholder="getInvoicePayDate" :value="getInvoicePayDate"  @change="updateDate" required>
    </div>
</template>

<script>
    import { mapGetters, mapMutations } from 'vuex';
    export default {
        props: [
            "inputClasses",
            "date"
        ],
        computed: {
            ...mapGetters(['getInvoicePayDate']),
        },
        methods: {
            ...mapMutations(['updateInvoicePayDate', 'initInvoicePayDate']),
            updateDate: function(event){
                console.log("EV", event);
                this.updateInvoicePayDate(event.target.value);
            }
        },
        mounted() {
            this.initInvoicePayDate(this.date);
        }
    }
</script>
