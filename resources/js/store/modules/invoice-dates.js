import { dateToInputFormat } from "../../helpers";
export default{
   
    state:{
        invoiceDate: undefined ,
        invoicePayDate: undefined,
    },
    getters:{
        getInvoiceDate: (state) => state.invoiceDate,
        getInvoicePayDate: (state) => state.invoicePayDate,
        
    },
    actions: {

    },
    mutations:{
        updateInvoiceDate: (state, date) => {
            const asDate = new Date(date);
            const payDate = state.invoicePayDate !== undefined ? new Date(state.invoicePayDate): undefined;
            state.invoiceDate = dateToInputFormat(date, 0);
            
            if(payDate === undefined||payDate.getTime() < asDate.getTime()){
                const twoWeeksLater = dateToInputFormat(date, 7);
                state.invoicePayDate = twoWeeksLater;
            }
       },
        initInvoiceDate: (state, date) => {
            state.invoiceDate = dateToInputFormat(date);
        },
        updateInvoicePayDate: (state, date) => {
            const updatedDate = new Date(date);
            const invoicePayDate = dateToInputFormat(updatedDate);
            if(new Date(state.invoiceDate).getTime() < updatedDate.getTime()){
                state.invoicePayDate = invoicePayDate;
                return;
            }
            /** Pay Date is before Invoice Date */
            alert("Datum liegt in der Vergangenheit hinter dem Rechnungsdatum!");
            const oneWeeksLater = dateToInputFormat(state.invoiceDate, 7)
            state.invoicePayDate = oneWeeksLater;
        },
        initInvoicePayDate: (state, date) => {
            if (date === undefined){
                state.invoicePayDate = dateToInputFormat(new Date());
                return;
            }
            const invoicePayDateString = dateToInputFormat(date);

            const invoiceDate = new Date(state.invoiceDate);
            const invoicePayDate = new Date(date);
            if(invoiceDate.getTime() < invoicePayDate.getTime()){
                state.invoicePayDate = invoicePayDateString;
            }
            
        
        }
        
    }
}