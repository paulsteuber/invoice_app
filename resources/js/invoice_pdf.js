pdfMake.fonts = {
    // download default Roboto font from cdnjs.com
    Roboto: {
      normal: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Regular.ttf',
      bold: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Medium.ttf',
      italics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Italic.ttf',
      bolditalics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-MediumItalic.ttf'
    },
 }
 

jQuery(function($){
    function floatToPrice(val){
        var stringVal = String(val);
        var splitted = stringVal.split(".");
        if(splitted.length > 1){
            if(splitted[1].length > 1){
                return splitted[0]+","+splitted[1];
            } else {
                return splitted[0]+","+splitted[1]+"0";
            }
        } else{
            return splitted[0]+",00";
        }
    }

    $(".pdfDownload").on("click", function(){
        var actionRow = $(this).parents(".actions");
        console.log("pdf", actionRow.find(".hidden_invoice_data").val().toString());
        var data = JSON.parse(actionRow.find(".hidden_invoice_data").val());

        var shortCustomerName = data.customer_name.length > 26 ? data.customer_name.split(" ")[0]:data.customer_name;
        var invoiceDate = $(actionRow).find(".invoice_date").text();
        
        console.log(data.positions);
        var positions_json = JSON.parse(data.all_positions);
        var all_positions = [[ {text:'#', bold:true}, {text:'Beschreibung', bold:true}, {text:'Anzahl', bold:true}, {text:'Netto', bold:true}, {text:'MwSt.', bold:true}, {text:'Netto Total', bold:true} ]]
        $(positions_json).each(function(index){
            var this_position = [index+1, this.description, this.count, floatToPrice(this.netto)+"€", this.mwst+"%", {text: floatToPrice(this.netto_sum)+"€", bold: true, alignment: 'right'} ];
            all_positions.push(this_position);

        });
        var mwst_json = JSON.parse(data.mwst_total);
        var mwst_columns = [];
        $(mwst_json).each(function(index){
            mwst_columns.push({
              columns: [
                {
                  // auto-sized columns have their widths based on their content
                  width: 'auto',
                  text: 'MwSt. '+this.percent+"%"
                },
                {
                  // star-sized columns fill the remaining space
                  // if there's more than one star-column, available width is divided equally
                  width: '*',
                  text: {text: floatToPrice(this.value)+"€"},
                  alignment:'right'
                },
              ], 
              style: 'normal',
              // optional space between columns
              columnGap: 10,
              margin: [330, 0,0, 0]
            });
        });


        var partial_data = {
          p_date: new Date(data.invoice_partial_pay_date),
          date: new Date(data.invoice_date)
        }
        function dateToString(date){
          return date.getDate()+"."+date.getMonth()+1+"."+date.getFullYear();
        }
        function partialRest(brutto, partial_brutto){
          return parseFloat(brutto)-parseFloat(partial_brutto)
        }
        var partial_pay_text = "Bitte überweisen Sie den Teilbetrag in Höhe von "+data.invoice_partial_pay_sum+"€ bis zum "+dateToString(partial_data.p_date)+".";
        var partial_pay_text_rest = "Den Restbetrag in Höhe von "+partialRest(data.brutto_total, data.invoice_partial_pay_sum)+"€ überweisen Sie bitte bis zum "+dateToString(partial_data.date)+" ohne Abzug von Skonto auf das unten angegebene Konto.";
        var not_partial_pay_text = 'Ich bitte Sie um die Begleichung der in Rechnung gestellten Summe innerhalb von 14 Tagen ohne Abzug von Skonto auf das unten angegebene Konto.';




        var dataToPDF = {
            
        content: [
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
            },
            
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
                text: invoiceDate,
                style: 'own_adress',
                margin: [0, 10, 0,0]
            },
            {
                text: "Rechnungsnummer: "+data.invoice_number,
                style: 'own_adress',
                bold: true,
                margin: [0, 0, 0,0]
            },
            {
                text: "Rechnung "+data.invoice_number+"-"+shortCustomerName ,
                style: 'headline',
                bold: true,
                margin: [0, 20, 0,0]
            },
            {
                text: data.invoice_description ,
                style: 'sub_headline',
                bold: true,
                color: '#b5b5b5',
                margin: [0, 0, 0,10]
            },
            {
                layout: 'lightHorizontalLines', // optional
                table: {
                  // headers are automatically repeated if the table spans over multiple pages
                  // you can declare how many rows should be treated as headers
                  headerRows: 1,
                  widths: [ 'auto', '*','auto', 'auto', 'auto', 'auto' ],
          
                  body: all_positions
                },
                style: "normal"
            },
            {
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
                  text: {text: floatToPrice(data.netto_total)+"€"},
                  alignment:'right'
                },
              ], 
              style: 'normal',
              // optional space between columns
              columnGap: 10,
              margin: [330, 20,0, 0]
          },
          mwst_columns,
          {
            columns: [
                  {
                    // auto-sized columns have their widths based on their content
                    width: 'auto',
                    text: {text: "SUMME", bold: true}
                  },
                  {
                    // star-sized columns fill the remaining space
                    // if there's more than one star-column, available width is divided equally
                    width: '*',
                    text: {text: floatToPrice(data.brutto_total)+"€", alignment:'right', bold: true}
                  },
                ], 
                style: 'normal',
                // optional space between columns
                columnGap: 10,
                margin: [330, 10,0, 0]
            },
            {
                text: data.invoice_partial_pay ? partial_pay_text+partial_pay_text_rest : not_partial_pay_text,
                margin: [0, 20, 0, 20],
                style: 'normal'
            },
            
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
                    text: data.invoice_number+ " "+shortCustomerName,
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
                    text: data.invoice_partial_pay ? data.invoice_partial_pay_sum+"€ (erster Teilbetrag) | "+partialRest(data.brutto_total, data.invoice_partial_pay_sum)+"€ (zweiter Teilbetrag)" : floatToPrice(data.brutto_total)+"€",
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
            },
            {
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
            }
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


        pdfMake.createPdf(dataToPDF).download(data.invoice_number+" "+shortCustomerName+" Rechnung");
    });

});