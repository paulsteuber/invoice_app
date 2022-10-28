<template>
    <div class="new-position col-sm-12">
        <table class="table table-borderless">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Bezeichnung</th>
                <th scope="col">Anzahl</th>
                <th scope="col">Netto</th>
                <th scope="col">MwSt.%</th>
                <th scope="col" class="text-right">Netto Total</th>
                </tr>
            </thead>
            <tbody v-for="(position, index) in allPositions" :key="position.id">
                <invoice-single-position-component :inputData="position"></invoice-single-position-component>
                   
            </tbody>
        </table>
        <!-- HIDDEN INPUT POSITION STORE-->
        <input id="all_positions" name="all_positions" type="hidden" :value="allPositionsToString"/>
        <input id="netto_total" name="netto_total" type="hidden" :value="sumForInput().netto"/>
        <input id="brutto_total" name="brutto_total" type="hidden" :value="sumForInput().brutto"/>
        <input id="mwst_total" name="mwst_total" type="hidden" :value="sumForInput().mwst"/>
        <div class="d-flex">
            <a class="add_position btn btn-primary"  @click="addPosition()">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path></svg>
                Weitere Position hinzufügen</a>
        </div>

        <div class="d-flex justify-content-end">
            <div class="sum-table offset-8 col-4 text-right">
                <div class="row netto-sum">
                    <div class="col-6">
                        Netto
                    </div>
                    <div class="col-6">
                        {{getSum.netto}}€
                    </div>
                </div>
                <!-- MWST -->

                <div class="mwst-list" v-for="(mwst, index) in getSum.mwst" :key="mwst">
                    <div class="row">
                        <div class="col-6">
                        MwSt. {{index}}%
                    </div>
                    <div class="col-6 text-align-right">
                        {{mwst}}€
                    </div>
                    </div>
                    
                </div>
                <!-- GESAMT -->
                <div class="row brutto-sum">
                    <div class="col-6">
                        GESAMT
                    </div>
                    <div class="col-6 ">
                        {{getSum.brutto}}€
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</template>

<script>   
    import { toFloat, parseToJsonArray } from '../../../helpers';
    import { mapGetters, mapMutations } from 'vuex';
    export default {
        props:[
            "oldPositions"
        ],
        computed: {
            ...mapGetters(['allPositions', 'defaultPosition', 'getSum', 'allPositionsToString']),
        },
        methods:{
            ...mapMutations(['addPosition', 'initPositions']),
            
            sumForInput: function(){
                const sum = {
                    netto: parseFloat(toFloat(this.getSum.netto)).toFixed(2),
                    brutto: parseFloat(toFloat(this.getSum.brutto)).toFixed(2),
                    mwst: (parseFloat(toFloat(this.getSum.brutto)) - parseFloat(toFloat(this.getSum.netto))).toFixed(2),
                };
                return sum;
            },
            initialOldPositions:function(){
                this.initPositions(parseToJsonArray(this.oldPositions));
            }
        },
        mounted(){
            if(this.oldPositions !== undefined){
                this.initialOldPositions();
            } else {
                this.addPosition();
            }
            
            
        }
        
    }
</script>