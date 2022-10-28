<template>
    <div>
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
                    <a type="button" class="pdfDownload" @click="createPDF">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                    <!-- INPUT FOR PDF DOWNLOAD -->
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
            {{invoiceData.customer_name_short}}
        </div>
        <div class="description">
            {{invoiceData.invoice_description_short}}
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
                <div class="h6">{{invoiceData.brutto_total}}€</div>
            </div>
        </div>
        
        <div class="status">
            <div :className="invoice_stateClass">
                <div class="draft">Entwurf</div>
                <div class="open">Offen</div>
                <div class="paid">Beglichen</div>
            </div>
        </div>
    </div>
</template>

<script>
    import {generateInvoicePDF} from '../../invoice_pdf'
    import {parseToJsonArray, dateToString, splitDateString, printCurrency} from '../../helpers'
    export default {
        props:[
        "invoice",
       // "mwst",
        ],
        
        data (){
            return {
                invoiceData: this.invoice,
                invoice_stateClass: "status-inner",
                editRoute:"",
            }
        },
        methods:{
            createPDF(){
                generateInvoicePDF(this.invoiceData);
            }

        }, 
        created(){
            this.invoiceData.invoice_date = dateToString(splitDateString(this.invoice.invoice_date)); 
            this.invoiceData.customer_name_short = this.invoiceData.customer_name.length > 25 ? this.invoiceData.customer_name.substring(0, 23)+"...": this.invoiceData.customer_name;
            this.invoiceData.invoice_description_short = this.invoiceData.invoice_description.length > 25 ? this.invoiceData.invoice_description.substring(0, 23)+"...": this.invoiceData.invoice_description;
            
            this.invoiceData.netto_total = printCurrency(this.invoiceData.netto_total);
            this.invoiceData.brutto_total = printCurrency(this.invoiceData.brutto_total); 
            this.invoiceData.mwst_total = printCurrency(this.invoiceData.mwst_total);
            this.invoice_stateClass = this.invoice_stateClass+" "+this.invoiceData.invoice_state;
            this.editRoute = "/invoice/"+this.invoiceData.id+"/edit";

            
           
        },
        mounted() {
            //console.log('Component mounted.', this.invoice)
        }
       
    }
</script>
