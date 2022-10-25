/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 import { createApp } from 'vue'
 import store from './store';
 // import the root component App from a single-file component.

 require('./bootstrap');
 var pdfMake = require('./pdfmake');
 
 
 require('./invoice_pdf');
 require('./customers');
 
 //window.Vue = require('vue').default;

 const app = createApp({});
app
    //LAYOUTS
    .component('customer-invoice-header-component', require('./components/layout/CustomerInvoiceHeaderComponent.vue').default)
    //INVOICES
    .component('customer-component', require('./components/invoices/CustomerComponent.vue').default)
    .component('invoice-number-component', require('./components/invoices/InvoiceNumberComponent.vue').default)
    .component('invoice-partial-pay-component', require('./components/invoices/PartialPayComponent.vue').default)
    .component('invoice-list-element-component', require('./components/invoices/InvoiceListElementComponent.vue').default)
    //customers
    .component('customer-overview-component', require('./components/customers/CustomerOverviewComponent.vue').default)
    .component('invoice-parent-position-component', require('./components/invoices/InvoiceParentPositionComponent.vue').default)
    .component('invoice-single-position-component', require('./components/invoices/InvoiceSinglePositionComponent.vue').default)
    .component('invoice-date-picker', require('./components/invoices/datepicker/InvoiceDatePicker.vue').default)
    .component('invoice-pay-date-picker', require('./components/invoices/datepicker/InvoicePayDatePicker.vue').default)

    //vuex store binding
    .use(store)
    /** last thing to do: mount to html object */
    .mount('#app');

 
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//layouts
//Vue.component('customer-invoice-header-component', require('./components/layout/CustomerInvoiceHeaderComponent.vue').default);
//invoices
//Vue.component('customer-component', require('./components/invoices/CustomerComponent.vue').default);
// Vue.component('invoice-number-component', require('./components/invoices/InvoiceNumberComponent.vue').default);
//Vue.component('invoice-position-component', require('./components/invoices/InvoicePositionComponent.vue').default);
//Vue.component('invoice-partial-pay-component', require('./components/invoices/PartialPayComponent.vue').default);
//Vue.component('invoice-list-element-component', require('./components/invoices/InvoiceListElementComponent.vue').default);
//customers
//Vue.component('customer-overview-component', require('./components/customers/CustomerOverviewComponent.vue').default);
//Vue.component('invoice-parent-position-component', require('./components/invoices/InvoiceParentPositionComponent.vue').default);
//Vue.component('invoice-single-position-component', require('./components/invoices/InvoiceSinglePositionComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


 
