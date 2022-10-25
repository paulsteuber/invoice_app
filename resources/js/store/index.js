import { createStore } from 'vuex'

import InvoicePositions from "./modules/invoice-positions";
import InvoiceDates from "./modules/invoice-dates";
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
    }
  });