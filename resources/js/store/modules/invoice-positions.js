
import { toFloat, printCurrency } from '../../helpers'
export default{
   
    state:{
        defaultPosition: {
            id: 0,
            description: "",
            quantity: 1,
            netto: "",
            mwst_rate: 19,
            brutto_total: 0,
            netto_total: 0,
            mwst_total: 0,
        },
        positions: [],

        sum: {
            netto: 0,
            brutto: 0,
            mwst: {},
        }
    },
    getters:{
        allPositions: (state) => state.positions,
        getPosition: (state, id) => state.positions[id],
        defaultPosition: (state) => state.defaultPosition,
        getSum:(state) => state.sum,
        allPositionsToString: (state) => {
            let output ="";
            state.positions.forEach(position => { 
                output += JSON.stringify(position);
            });
            return output;
        },
    },
    actions: {

    },
    mutations:{
        initPositions(state, positions){
            state.positions = positions;
            this.commit("calculateSum");
        },
        addPosition(state){
            let newDefaultPosition =  Object.assign({}, state.defaultPosition);
            newDefaultPosition.id = state.positions.length;
            state.positions.push(newDefaultPosition);
            this.commit("calculateSum");
        },
        removePosition(state, id){

            //if only one position exists --> clear the data
            if(state.positions.length <= 1){
                state.positions = [];
                this.commit("addPosition");
                return;
            }
            state.positions.splice(id, 1);
            // set id for all positions new 
            state.positions.forEach((position, index) => { 
                position.id = index;
            });

            this.commit("calculateSum");
        },
        copyPosition(state, copyPos){
            const newPos =  Object.assign({}, copyPos);
            newPos.id = state.positions.length;
            state.positions.push(newPos);
            this.commit("calculateSum");

        },
        updatePosition(state, updatePos){
            state.positions[updatePos.id] = updatePos;
            this.commit("calculateSum");
        },
        calculateSum(state){

            //delete old state sum
            state.sum = {
                netto: 0,
                brutto: 0,
                mwst: {},
            }

            //calculate new
            state.positions.forEach((position, index) => { 
                
                state.sum.netto = printCurrency(toFloat(state.sum.netto) + toFloat(position.netto_total));
                state.sum.brutto = printCurrency(toFloat(state.sum.brutto) + toFloat(position.brutto_total));


                //mwst
                const mwst_total = toFloat(position.mwst_total);
                if(state.sum.mwst[""+position.mwst_rate] !== undefined){
                    
                    state.sum.mwst[""+position.mwst_rate] =printCurrency(toFloat(state.sum.mwst[""+position.mwst_rate]) + mwst_total);
                } else {
                    state.sum.mwst[""+position.mwst_rate] = printCurrency(mwst_total);
                }
            });

            
        }
        
    }
}