<template>
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Beschreibung</th>
                <th scope="col">Anzahl</th>
                <th scope="col">Netto</th>
                <th scope="col">MwSt.%</th>
                <th scope="col" class="text-right">Netto Total</th>
                </tr>
            </thead>
            <tbody>

                <!-- 
                    




                --> 
                <!-- 
                    




                --> 
                <tr v-model="positions" v-for="(invoice_pos, index) in positions" :class="'invoice_position_'+index+1">
                    <th scope="row">{{index+1}}
                        <a type="button" class="remove-pos ml-4" @click="deletePosition(index)">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M19 24h-14c-1.104 0-2-.896-2-2v-17h-1v-2h6v-1.5c0-.827.673-1.5 1.5-1.5h5c.825 0 1.5.671 1.5 1.5v1.5h6v2h-1v17c0 1.104-.896 2-2 2zm0-19h-14v16.5c0 .276.224.5.5.5h13c.276 0 .5-.224.5-.5v-16.5zm-9 4c0-.552-.448-1-1-1s-1 .448-1 1v9c0 .552.448 1 1 1s1-.448 1-1v-9zm6 0c0-.552-.448-1-1-1s-1 .448-1 1v9c0 .552.448 1 1 1s1-.448 1-1v-9zm-2-7h-4v1h4v-1z"/></svg>                   
                        </a> 
                    </th>
                    <td class="add_description"><input type="text" class="form-control" v-model="invoice_pos.description"></td>
                    <td>
                    <span class="position_counter font-weight-bold">{{invoice_pos.count}}</span>
                    <a class="position_countUp btn btn-primary " @click="countUp(invoice_pos, true)">+</a>
                    <a class="position_countDown btn btn-outline-primary" @click="countUp(invoice_pos, false)">-</a>
                    <input class="form-control" type="hidden"  v-model="invoice_pos.count" @change="calcNettoSum(invoice_pos)">
                    </td>
                    <td><input class="form-control netto" type="text" v-model="invoice_pos.netto" @keyup="calcNettoSum(invoice_pos)"></td>
                    <td><input class="form-control mwst" type="text" v-model="invoice_pos.mwst" @keyup="calcNettoSum(invoice_pos)"></td>
                    <th class="text-right">{{displayFloat(invoice_pos.netto_sum)}}€</th>
                </tr>
            </tbody>
        </table>
        <div class="add_position_wrap d-flex justify-content-center">
            <a class="add_position btn btn-primary"  @click="addPosition()">Neue Position hinzufügen</a>
        </div>

        <hr class="mt-5">
        
        <table class="table table-borderless col-lg-4 offset-lg-8 mt-2">
            <tbody class="text-right">
                <tr>
                    <th>Netto</th>
                    <td class="text-right">{{displayFloat(total.netto)}}€</td>
                </tr>
                <tr  v-for="elem in total.mwst">
                    <th>{{elem.percent}}% MwSt.</th>
                    <td class="text-right">{{displayFloat(elem.value)}}€</td>
                </tr>
                <tr>
                    <th class="h5" style="font-weight: 700">GESAMT</th>
                    <th class="h5 text-right">{{displayFloat(total.brutto)}}€</th>
                </tr>
            </tbody>
        </table>
        <div class="hidden_inputs">
            <input type="hidden" id="all_positions" name="all_positions" v-model="positions_json_string">

            <input type="hidden" id="netto_total" name="netto_total" v-model="total.netto">
            <input type="hidden" id="mwst_total" name="mwst_total" v-model="total.mwst_json_string">
            <input type="hidden" id="brutto_total" name="brutto_total" v-model="total.brutto">
        </div>
    </div>
</template>
<script>

export default {  
    props:[
        "oldPositions"
    ],
    data () {
        return {
            
            positions: [
                {
                    'description': '',
                    'count' : 1,
                    'netto' : '',
                    'mwst' : 19,
                    'netto_sum' : 0
                }
            ],
            positions_json_string: '',
            total: {
                'netto': 0,
                'brutto': 0,
                'mwst': [],
                'mwst_json_string' : '',
            }
        }
    },
        created: function(){
            var old_pos = JSON.parse(this.oldPositions);
            var created_position = [];
            old_pos.forEach(function(pos, index){
                var default_pos = {
                    'description': pos.description,
                    'count' : parseInt(pos.count),
                    'netto' : parseFloat(pos.netto),
                    'mwst' : parseFloat(pos.mwst),
                    'mwst_sum': parseFloat(pos.mwst_sum),
                    'netto_sum' : parseFloat(pos.netto_sum)
                };
                console.log(default_pos);
                created_position.push(default_pos)
            });
            this.positions = created_position;
            this.refreshTotal();
            this.refreshPositionsToString();
        },
        methods:{
            addPosition: function(){
                var default_pos = {
                    'description': '',
                    'count' : 1,
                    'netto' : '',
                    'mwst' : 19,
                    'mwst_sum': 0,
                    'netto_sum' : 0
                };
                this.positions.push(default_pos);
            },
            deletePosition: function(index){
                if(this.positions.length > 1){
                    Vue.delete(this.positions, index);
                    this.refreshTotal();
                }
            },
            countUp: function(val, up){
                  if(val.count <= 1 && !up){
                    console.log("Negative Rechnungsnummer ist nicht erlaubt");
                } else{
                     up ? val.count++ : val.count--;
                }
                this.calcNettoSum(val)
            },
            calcNettoSum: function(invoice_pos){
                var netto = parseFloat(invoice_pos.netto) ? invoice_pos.netto.toString() : '0';
                console.log(netto)
                var commaToPoint = netto.replace(',', '.');
                var parsedSum = parseFloat(commaToPoint)*invoice_pos.count;
                var mwst = parsedSum * (invoice_pos.mwst/100);
               
                invoice_pos.mwst_sum =  this.round2(mwst).toString().replace(',', '.');
                invoice_pos.netto_sum = this.round2(parsedSum).toString().replace(',', '.');

                this.refreshTotal();
                this.refreshPositionsToString();
            },
            round2: function(value){
                return Math.round((value + Number.EPSILON) * 100) / 100;
            },
            displayFloat: function(float){
                var value = float.toString();
                if(value.includes(".")){
                    value = value.split(".");
                    var dec = value[1] ? value[1] : "00";
                    if(dec.length == 1){
                        dec =value[1] +"0";
                    }
                    value = value[0]+","+ dec;
                } else {
                    value = value + ",00";
                }
                return value;
            },
            refreshTotal: function(){
                var netto = 0;
                var brutto = 0;
                var mwstArray = [];

                this.positions.forEach(element => {
                    netto = this.round2(netto + parseFloat(element.netto_sum));
                    element.mwst_sum = parseFloat(element.mwst_sum) ? element.mwst_sum : 0;
                    brutto = this.round2(brutto + parseFloat(element.netto_sum) + parseFloat(element.mwst_sum));

                    var mwst_is_set = false;
                    if(mwstArray.length){
                        mwstArray.forEach(mwstElem => {
                            if(mwstElem.percent == element.mwst){
                                if(!parseFloat(mwstElem.value)){
                                    mwstElem.value = ""+this.round2(0 + parseFloat(element.mwst_sum));
                                } else{
                                    mwstElem.value = ""+this.round2(parseFloat(mwstElem.value) + parseFloat(element.mwst_sum));
                                }
                                mwst_is_set = true;
                            }
                        });
                    }
                    if (!mwst_is_set){
                        mwstArray.push({
                            "percent": ""+element.mwst,
                            "value": ""+this.round2(parseFloat(element.mwst_sum))
                        });
                    }

                });

                // clear mwstArray -> delete empty elem
                mwstArray.forEach(function(mwstElem, index)  {
                    if (mwstElem.value == 0){
                        mwstArray.splice(index,1);
                    }
                }); 
                this.total.netto= netto;
                this.total.brutto= brutto;
                this.total.mwst = mwstArray;

                this.refreshTotalMwStToString();
            },
            refreshTotalMwStToString: function(){
                this.total.mwst_json_string = JSON.stringify(this.total.mwst);
            },
            refreshPositionsToString: function(){
                this.positions_json_string = JSON.stringify(this.positions);
            }
        },
        computed:{
        }
}
</script>