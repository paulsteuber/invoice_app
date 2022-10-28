export default{
   
    state:{
        invoiceFilter: {

        },
        invoiceSort: {

        },
        invoices: {}
    },
    getters:{
        getInvoices: (state) => state.invoices,
    },
    actions: {

    },
    mutations:{
        initialInvoices: (state) => {
            axios
            .get('/json/auth/invoices/')
            .then(response => {
                state.invoices = response.data;
                console.log(state.invoices);
            });
            
        }
    }
}