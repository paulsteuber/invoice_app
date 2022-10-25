<template>
    <div class="datepicker invoice-date">
            <input id="invoice_date" type="date" name="invoice_date" :classList="inputClasses"  :value="getInvoiceDate" :placeholder="getInvoiceDate" @change="updateDate" required>
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
            ...mapGetters(['getInvoiceDate']),
        },  
        methods: {
            ...mapMutations(['updateInvoiceDate', 'initInvoiceDate']),

            updateDate: function(event){
                this.updateInvoiceDate(event.target.value);
            }
        },
        mounted() {
            this.initInvoiceDate(this.date);
        }
    }
</script>