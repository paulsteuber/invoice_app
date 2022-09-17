<template>
    <div class="invoice-list-element">
        {{invoiceData}}
        <div class="number">
            {{invoiceData.invoice_number}}
        </div>
        <div class="date">
            {{invoiceData.invoice_date}}
        </div>
        <div class="name">
            {{invoiceData.customer_name}}
        </div>
        <div class="description">
            {{invoiceData.invoice_description}}
        </div>
        <div class="netto">
            {{invoiceData.netto_total}}
        </div>
        <div class="mwst">
            {{invoiceData.mwst_total}}
        </div>
        <div class="brutto">
            {{invoiceData.brutto_total}}
        </div>
        <div class="status">
            {{invoiceData.invoice_state}}
        </div>
        <div class="actions">
            <a type="button" class="pdfDownload">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                </svg>
            </a>
            <input type="hidden" class="hidden_invoice_data" :value="invoiceData">

            <a type="button" class="edit_invoice ml-2" :href="edit-route">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                </svg>
            </a>  
        </div>
       
        invoice_state
    </div>
</template>

<script>
    export default {
        props:[
        "invoice",
        "mwst",
        "edit-route"
        ],
        data (){
            return {
                invoiceData: JSON.parse(this.invoice)

            }
        },
        methods:{
            ymdToDate: function(dateString){
                let splitted = dateString.split("-");
                return new Date(splitted[0],splitted[1],splitted[2])
            },
            dateToString: function(date){
                return date.getDate().toString().padStart(2, "0")+"."+date.getMonth().toString().padStart(2, "0")+"."+date.getFullYear();
            },
            moneyToString(num){
                let floatString = parseFloat(num).toString();
                if(floatString.includes(".")){
                    console.log(floatString);
                    return floatString.replace(".", ',');
                } else {
                    return floatString+",00";
                }
            }

        },
        created(){
            this.invoiceData.invoice_date = this.dateToString(this.ymdToDate(this.invoiceData.invoice_date));
            
            this.invoiceData.mwst_total = this.moneyToString(JSON.parse(this.mwst.slice(1, -1)).value);
            this.invoiceData.netto_total = this.moneyToString(this.invoiceData.netto_total);
            this.invoiceData.brutto_total = this.moneyToString(this.invoiceData.brutto_total);
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
