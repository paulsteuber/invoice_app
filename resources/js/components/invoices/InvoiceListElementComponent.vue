<template>
    <div class="col-md-3 invoice-list-element shadow-sm">
        <div class="d-flex flex-column align-items-start">
            <div class="full-width d-flex justify-content-between">
                <div class="date d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg>
                    {{invoiceData.invoice_date}}
                </div>
                <div class="actions">
                    <a type="button" class="pdfDownload">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                    <input type="hidden" class="hidden_invoice_data" :value="invoice">

                    <a type="button" class="edit_invoice ml-2" :href="editRoute">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg>
                    </a>  
                </div>
        
            </div>
         
            <div class="number h5">
             # {{invoiceData.invoice_number}}
            </div>
        </div>
        
        
        <div class="name">
            {{invoiceData.customer_name}}
        </div>
        <div class="description">
            {{invoiceData.invoice_description}}
        </div>
        <div class="financial d-flex justify-content-between">
            <div class="netto d-flex flex-column">
                <span>Netto</span>
                {{invoiceData.netto_total}}€
            </div>
            <div class="mwst d-flex flex-column">
                <span>MwSt.</span>
                {{invoiceData.mwst_total}}€
            </div>
            <div class="brutto d-flex flex-column">
                <span>Brutto</span>
                {{invoiceData.brutto_total}}€
            </div>
        </div>
        
        <div class="status">
            {{invoiceData.invoice_state}}
        </div>
        
    </div>
</template>

<script>
    export default {
        props:[
        "invoice",
        "mwst",
        "editRoute"
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
            this.invoiceData.customer_name = this.invoiceData.customer_name.length > 25 ? this.invoiceData.customer_name.substring(0, 23)+"...": this.invoiceData.customer_name;
            this.invoiceData.invoice_description = this.invoiceData.invoice_description.length > 25 ? this.invoiceData.invoice_description.substring(0, 23)+"...": this.invoiceData.invoice_description;
            let mwstArray = this.mwst.slice(1, -1).split(",");
            console.log(mwstArray);
            for(const mwst of mwstArray){
                let val = parseFloat(JSON.parse(mwst).value);
                console.log(val)
            }
            
            console.log(mwsttotal);
           
            this.invoiceData.netto_total = this.moneyToString(this.invoiceData.netto_total);
            this.invoiceData.brutto_total = this.moneyToString(this.invoiceData.brutto_total);
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
