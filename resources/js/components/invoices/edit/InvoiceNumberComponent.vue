<template>
    <div class="col-md-4">
        <div class="row">
           <label for="name" class="col-md-12 col-form-label">Rechnungsnummer</label>
           <div class="col-lg-6 number-wrapper">
            <input class="form-control" type="text" id="invoice_number" name="invoice_number" v-model="invoiceNumber" @keyup="changeInput" @change="changeInput"/>
            <p :class="warningVisibilityClass">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                </svg>
                {{warningMessage}}</p>
           </div>
           <div class="col-lg-6 d-flex justify-content-center">
                <a class="btn btn-primary " v-on:click="numIncrease()">+</a>
                <a class="btn btn-outline-primary ml-1" v-on:click="numDecrease()">-</a>
           </div>
        </div>
    </div>

</template>
<script>

export default {
    props:[
        'nextInvoiceNumber',
        'allInvoiceNumbers'
    ],
    data () {
        return {
            invoiceNumber: this.nextInvoiceNumber,
            warningMessage: '',
            warningVisibilityClass : 'warning-message d-none',
            allInvoiceNumbersArray: this.allInvoiceNumbers.split(","),
            oldInvoiceNumber : this.nextInvoiceNumber
        }
    },
        mounted() {
            console.log("ALL", this.allInvoiceNumbers )
        },
        methods:{
            numIncrease: function(){
                const nextValidNum = this.findNextAllowedNumber(true);
                this.invoiceNumber = nextValidNum;
            },
            numDecrease: function(){
                if(this.invoiceNumber === 1){
                    console.log("Negative Rechnungsnummer ist nicht erlaubt");
                    return;
                }
                const nextValidNum = this.findNextAllowedNumber(false);
                this.invoiceNumber = nextValidNum;
            },
            findNextAllowedNumber: function(increase){
                if(increase){
                    let numIncreased = parseInt(this.invoiceNumber)+1;
                    while(this.allInvoiceNumbersArray.includes(String(numIncreased))){
                        numIncreased++;
                    }
                    return numIncreased;
                }
                if(!increase){
                    let numDecreased = parseInt(this.invoiceNumber)-1;
                    while(this.allInvoiceNumbersArray.includes(String(numDecreased))){
                        numDecreased--;
                    }
                    return numDecreased;
                }
            },
            changeInput: function(e) {
                const val = e.target.value;
                const oldInvoiceNum = parseInt(this.invoiceNumber);
                let newInvoiceNum = parseInt(String(val).replace(/\D/g, ""));
                if(val.length !== String(newInvoiceNum).length){
                    this.warningActive(
                        "Nur Ziffern werden übernommen"
                    );
                    this.invoiceNumber = oldInvoiceNum;
                    return;
                }
                this.warningInactive();

                if(this.allInvoiceNumbersArray.includes(String(newInvoiceNum))){
                    console.log("OLD", this.oldInvoiceNumber, "NEW", newInvoiceNum);
                    console.log(this.oldInvoiceNumber > newInvoiceNum);
                    if(newInvoiceNum > this.oldInvoiceNumber){
                        this.invoiceNumber = newInvoiceNum - 1;
                        newInvoiceNum = this.findNextAllowedNumber(true);
                    }
                    if(this.oldInvoiceNumber > newInvoiceNum){
                        this.invoiceNumber = newInvoiceNum + 1;
                        newInvoiceNum= this.findNextAllowedNumber(false);
                    }
                }
               this.oldInvoiceNumber = newInvoiceNum;
                this.invoiceNumber = newInvoiceNum;
            },
            warningInactive: function(){
                this.warningVisibilityClass = 'warning-message d-none';
            },
            warningActive: function(message){
                this.warningVisibilityClass = 'warning-message';
                this.warningMessage = message;
            }
        },
        computed:{
            
        }
}
</script>