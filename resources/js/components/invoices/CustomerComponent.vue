<template>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-12">
                <div class="row">
                    <label for="name" class="col-md-12 col-form-label">Kunde auswählen</label>
                    <div class="col-md-12">
                        <input id="customer-search" class="form-control" type="text" v-model="customersearch" name="customer-search" placeholder="Tippe den Namen deines Kunden hier ein" autofocus>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div :class="customersearch.length ? 'col-md-12' : 'd-none'" id="customer-results">
                <div>
                    <ul class="list-group">
                        <li class="list-group-item"  v-for="customer in filteredCustomers"  >
                        <div v-on:click="selectCustomer(customer)">
                            <div class="row">
                                <div class="col-lg-12">
                                    <span class="h5 mr-2 mb-0">{{customer.name}}</span>
                                </div>
                                <div class="col-lg-12 font-weight-light">
                                    <hr class="my-2">
                                    <span class="mr-2">{{customer.alias_name}}</span>
                                    <span class="mr-2">{{customer.street}}</span>
                                    <span class="mr-2">{{customer.zip}} {{customer.city}}</span>
                                </div>
                            </div>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="customer-invoice-inputs">
            <input type="hidden" name="customer_id" :value="selectedcustomer.id">
            <div class="row">
                <div class="form-group col-md-6">
                        <div class="row">
                            <label for="customer_name" class="col-md-12 col-form-label">Name</label>
                            <div class="col-md-12">
                                <input id="customer_name" class="form-control" type="text"  name="customer_name" :value="selectedcustomer.name" required>
                            </div>
                        </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="row">
                        <label for="customer_alias" class="col-md-12 col-form-label">Alias</label>
                        <div class="col-md-12">
                            <input id="customer_alias" class="form-control" type="text"  name="customer_alias" :value="selectedcustomer.alias_name">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="row">
                        <label for="customer_street" class="col-md-12 col-form-label">Straße</label>
                        <div class="col-md-12">
                            <input id="customer_street" class="form-control" type="text"  name="customer_street" :value="selectedcustomer.street" required>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="row">
                        <label for="customer_zip" class="col-md-12 col-form-label">PLZ</label>
                        <div class="col-md-12">
                            <input id="customer_zip" class="form-control" type="text"  name="customer_zip" :value="selectedcustomer.zip" required>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="row">
                        <label for="customer_city" class="col-md-12 col-form-label">City</label>
                        <div class="col-md-12">
                            <input id="customer_city" class="form-control" type="text"  name="customer_city" :value="selectedcustomer.city" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <div class="row">
                        <label for="customer_mail" class="col-md-12 col-form-label">Mail</label>
                        <div class="col-md-12">
                            <input id="customer_mail" class="form-control" type="text"  name="customer_mail" :value="selectedcustomer.mail">
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <div class="row">
                        <label for="customer_website" class="col-md-12 col-form-label">Webseite</label>
                        <div class="col-md-12">
                            <input id="customer_website" class="form-control" type="text"  name="customer_website" :value="selectedcustomer.website">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
              
</template>
<script>
export default {
    props:[
        "oldInvoiceId"
    ],
    data () {
        return {
            oldInvoice: {},
            customers: [],
            customersearch: '',
            selectedcustomer: {} ,
        }
    },
        mounted() {
           axios
                .get('/json/auth/customers')
                .then(response => {
                    this.customers = response.data;
                });
            if(this.oldInvoiceId){
                axios
                .get('/json/auth/invoice/'+this.oldInvoiceId)
                .then(response => {
                    this.selectedcustomer = {
                        id: response.data.customer_id,
                        name: response.data.customer_name,
                        alias_name: response.data.customer_alias,
                        city: response.data.customer_city,
                        street: response.data.customer_street,
                        zip: response.data.customer_zip,
                        mail: response.data.customer_mail,
                        website: response.data.customer_website 
                    }
                });
            }
            
        },
        methods:{
            selectCustomer: function(clicked_customer){
                this.selectedcustomer = clicked_customer;
                this.customersearch = '';
            }
        },
        computed:{
            filteredCustomers:function(customersearch){
                    return this.customers.filter((customer)=> {
                            var search_lower = this.customersearch.toLowerCase().trim();
                            var customer_lower = {
                                'name': customer.name.toLowerCase().trim(),
                                'alias_name': customer.alias_name ? customer.alias_name.toLowerCase().trim(): ''

                            }
                            return customer_lower.name.match(search_lower) || customer_lower.alias_name.match(search_lower);
                    
                    });  
                
            }
        }
}
</script>