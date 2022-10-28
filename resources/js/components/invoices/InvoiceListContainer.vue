<template>
    <div>
        <div class="filter-sort-container d-flex justify-content-between mb-4">
            <invoice-filter-container></invoice-filter-container>
            <div class="sort">
                <div class="btn-group" role="group" aria-label="Sortieren nach">
                        <button type="button" class="btn btn-sm btn-primary">Zeit</button>
                        <button type="button" class="btn btn-sm btn-secondary">Rechnungsnummer</button>
                </div>
            </div>

        </div>
        <div class="invoice-list col-12">
            <div class="row d-flex">
                <div class="col-md-3 invoice-list-element shadow-sm" v-for="(invoice, index) in getInvoices" :key="invoice.id">
                    <invoice-list-element-component :invoice="invoice"></invoice-list-element-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapMutations } from 'vuex';
    export default {
        
        computed: {
            ...mapGetters(['getInvoices']),
        },
        methods:{
            ...mapMutations(['initialInvoices']),
        },
        mounted() {
            this.initialInvoices();
        }
    }
</script>
