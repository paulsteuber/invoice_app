import { createStore } from 'vuex'

import InvoicePositions from "./modules/invoice-positions";
import InvoiceDates from "./modules/invoice-dates";
import InvoiceList from "./modules/invoice-list";
export default createStore({
    state:{
     
    },
    getters:{

    },
    mutations: {
    },
    actions:{

    },
    modules:{
        InvoicePositions,
        InvoiceDates,
        InvoiceList
    }
  });