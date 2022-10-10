import {parseToJsonArray, printCurrency, toFloat} from './helpers';

pdfMake.fonts = {
    // download default Roboto font from cdnjs.com
    Roboto: {
      normal: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Regular.ttf',
      bold: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Medium.ttf',
      italics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Italic.ttf',
      bolditalics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-MediumItalic.ttf'
    },
 }
export function generateInvoicePDF(data){
  const ALL_POSITIONS = parseToJsonArray(data.all_positions);
  const specialData = {
    shortCustomerName: data.customer_name.length > 26 ? data.customer_name.split(" ")[0]:data.customer_name,
    partial_date: new Date(data.invoice_partial_pay_date),
    date: new Date(data.invoice_date),
    partial_pay_text: "Bitte überweisen Sie den Teilbetrag in Höhe von "+data.invoice_partial_pay_sum+"€ bis zum "+".",
    partial_pay_text_rest: "Den Restbetrag in Höhe von "+"€ überweisen Sie bitte bis zum "+" ohne Abzug von Skonto auf das unten angegebene Konto.",
    not_partial_pay_text: 'Ich bitte Sie um die Begleichung der in Rechnung gestellten Summe innerhalb von 14 Tagen ohne Abzug von Skonto auf das unten angegebene Konto.',

  }

  // CUSTOMER ADDRESS
  const customerAddress =  [
    {
        text: data.customer_name ,
        style: 'customer'
    },
    {
        text: data.customer_alias,
        style: 'customer'
    },
    {
        text: data.customer_street,
        style: 'customer'
    },
    {
        text: data.customer_zip +" "+ data.customer_city,
        style: 'customer',
        margin: [0,0,0,5]
    }
  ];

  // YOUR OWN ADDRESS
  const ownAddress = [
    {
        text: data.name,
        style: 'own_adress',
    },

    {
        text: data.street,
        style: 'own_adress',
    },

    {
        text: data.zip + " " + data.city,
        style: 'own_adress',
    },
    {
        text: data.invoice_date,
        style: 'own_adress',
        margin: [0, 10, 0,0]
    },
    {
        text: "Rechnungsnummer: "+data.invoice_number,
        style: 'own_adress',
        bold: true,
        margin: [0, 0, 0,0]
    }
  ];
  const invoiceDescription = [
    {
      text: data.invoice_description ,
      style: 'sub_headline',
      bold: true,
      color: '#b5b5b5',
      margin: [0, 0, 0,10]
    }
  ];
  /**
   * 
   *  LOOP ALL POSITIONS
   * 
   */
  let position_list = [[ {text:'#', bold:true}, {text:'Beschreibung', bold:true}, {text:'Anzahl', bold:true}, {text:'Netto', bold:true}, {text:'MwSt.', bold:true}, {text:'Netto Total', bold:true} ]]
  ALL_POSITIONS.forEach(function(pos, index){
    console.log(pos);
    var pos = [index+1, pos.description, pos.quantity, printCurrency(toFloat(pos.netto))+"€", pos.mwst_rate+"%", {text: printCurrency(toFloat(pos.netto_total))+"€", bold: true, alignment: 'right'} ];
    position_list.push(pos);

  });
  const positionTable = [
    {
      layout: 'lightHorizontalLines', // optional
      table: {
        // headers are automatically repeated if the table spans over multiple pages
        // you can declare how many rows should be treated as headers
        headerRows: 1,
        widths: [ 'auto', '*','auto', 'auto', 'auto', 'auto' ],
  
        body: position_list
      },
      style: "normal"
    },
  ];

  const nettoTotal = {
    columns: [
      {
        // auto-sized columns have their widths based on their content
        width: 'auto',
        text: 'Netto'
      },
      {
        // star-sized columns fill the remaining space
        // if there's more than one star-column, available width is divided equally
        width: '*',
        text: {text: data.netto_total+"€"},
        alignment:'right'
      },
    ], 
    style: 'normal',
    // optional space between columns
    columnGap: 10,
    margin: [330, 20,0, 0]
};
  /**
   * 
   *  LOOP ALL MWSTs
   * 
   */
  const mwstArr = {};
  ALL_POSITIONS.forEach((pos, index) => { 
  //mwst
    if(mwstArr[pos.mwst_rate] !== undefined){
      mwstArr[pos.mwst_rate] = mwstArr[pos.mwst_rate]+toFloat(pos.mwst_total);
    } else {
      mwstArr[pos.mwst_rate] = toFloat(pos.mwst_total);
    }
  });
  let mwstColumns = [];

  for (const [key, value] of Object.entries(mwstArr)) {
    mwstColumns.push({
      columns: [
        {
          // auto-sized columns have their widths based on their content
          width: 'auto',
          text: 'MwSt. '+key+"%"
        },
        {
          // star-sized columns fill the remaining space
          // if there's more than one star-column, available width is divided equally
          width: '*',
          text: {text: printCurrency(value)+"€"},
          alignment:'right'
        },
      ], 
      style: 'normal',
    // optional space between columns
      columnGap: 10,
      margin: [330, 0,0, 0]
    });
  }
  const bruttoTotal = {
    columns: [
      {
        // auto-sized columns have their widths based on their content
        width: 'auto',
        text: {text:'Brutto', bold:true}
      },
      {
        // star-sized columns fill the remaining space
        // if there's more than one star-column, available width is divided equally
        width: '*',
        text: {text: data.brutto_total+"€", bold:true},
        alignment:'right'
      },
    ], 
    style: 'normal',
    // optional space between columns
    columnGap: 10,
    margin: [330, 0,0, 0]
};
  const bankTransfer = [
  {
    columns: [
      {
        // auto-sized columns have their widths based on their content
        width: 120,
        text: 'Kontoinhaber'
      },
      {
        // star-sized columns fill the remaining space
        // if there's more than one star-column, available width is divided equally
        width: 'auto',
        text: data.name
      },
    ], 
    style: 'normal',
    // optional space between columns
    columnGap: 10
},
{
    columns: [
      {
        width: 120,
        text: 'IBAN'
      },
      {
        width: 'auto',
        text: data.iban
      },
    ],
    style: 'normal',
    // optional space between columns
    columnGap: 10
},
 {
    columns: [
      {
        width: 120,
        text: 'BIC'
      },
      {
        width: 'auto',
        text: data.bic
      },
    ],
    style: 'normal',
    // optional space between columns
    columnGap: 10
  },
 {
    columns: [
      {
        width: 120,
        text: 'Bank'
      },
      {
        width: 'auto',
        text: data.bank
      },
    ],
    style: 'normal',
    // optional space between columns
    columnGap: 10
  },
  {
    columns: [
      {
        width: 120,
        text: 'Verwendungszweck'
      },
      {
        width: 'auto',
        text: data.invoice_number+ " "+specialData.shortCustomerName,
      },
    ],
    style: 'normal',
    // optional space between columns
    columnGap: 10
  },
  {
    columns: [
      {
        width: 120,
        text: 'Betrag'
      },
      {
        width: 'auto',
        text: data.invoice_partial_pay ? data.invoice_partial_pay_sum+"€ (erster Teilbetrag) | "+"€ (zweiter Teilbetrag)" : data.brutto_total+"€",
      },
    ],
    style: 'normal',
    // optional space between columns
    columnGap: 10
  },

  {
      text: 'Vielen Dank für Ihren Auftrag!',
      margin: [0, 10, 0, 0],
      style: 'normal'
  },
  {
      text: 'Mit freundlichen Grüßen',
      margin: [0, 0, 0, 10],
      style: 'normal'
  },
  {
      text: data.name,
      style: 'normal'
  }];

  const footer = {
    columns: [
        {
          width: 'auto',
          text: data.name+"\n"+data.street+"\n"+data.zip+" "+data.city
        },
        {
          width: 'auto',
          text: "E-Mail: "+data.mail+"\n"+"Webseite: "+data.url+"\n"+"Telefon: "+data.phone+"\n"+"USt-ID: "+data.tax_id
        },
        {
          width: 'auto',
          text: "IBAN: "+data.iban+"\n"+"BIC: "+data.bic+"\n"+"Bank: "+data.bank+"\n"
        },
      ],
      style: 'small',
      color: '#b5b5b5',
      margin:[0, 15, 0, 0],
      // optional space between columns
      columnGap: 20
  };
 
  /** PDF MAKE */
  const dataToPDF = {
    content: [
      customerAddress, 
      ownAddress,
      invoiceDescription,
      positionTable,
      nettoTotal,
      mwstColumns,
      bruttoTotal,
      bankTransfer,
      footer

    ],
    styles: {
      normal:{
          fontSize: 9,
          lineHeight: 1.2,
      },
      customer: {
          fontSize: 11,
          lineHeight: 1.2,
      },
      own_adress: {
          fontSize: 9,
          lineHeight: 1.2,
          alignment: 'right',
      },
      headline: {
          fontSize: 20,
          lineHeight: 1.3
      },
      sub_headline: {
          fontSize: 14,
          lineHeight: 1.2
      },
      large: {
          fontSize: 12
      },
      small: {
          fontSize: 7,
          lineHeight: 1.1,
      }
    },
    // a string or { width: number, height: number }
    pageSize: 'A4',

    // [left, top, right, bottom] or [horizontal, vertical] or just a number for equal margins
    pageMargins: [ 80, 100, 80, 40 ],
  }
  pdfMake.createPdf(dataToPDF).download(data.invoice_number+" "+specialData.shortCustomerName+" Rechnung");
} 

jQuery(function($){
     $("#pdfDownload").on("click", function(){
        
        console.log(data.positions);
        var positions_json = JSON.parse(data.all_positions);
        var all_positions = [[ {text:'#', bold:true}, {text:'Beschreibung', bold:true}, {text:'Anzahl', bold:true}, {text:'Netto', bold:true}, {text:'MwSt.', bold:true}, {text:'Netto Total', bold:true} ]]
        $(positions_json).each(function(index){
            var this_position = [index+1, this.description, this.count, floatToPrice(this.netto)+"€", this.mwst+"%", {text: floatToPrice(this.netto_sum)+"€", bold: true, alignment: 'right'} ];
            all_positions.push(this_position);

        });
        

        var dataToPDF = {
            
       
        
    }


        pdfMake.createPdf(dataToPDF).download(data.invoice_number+" "+shortCustomerName+" Rechnung");
    });

});