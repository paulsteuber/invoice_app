export default{
    state:{
        defaultPosition: {
            id: 0,
            description: "TEST",
            quantity: 1,
            netto: 0,
            mwst_rate: 19,
            brutto_total: 0,
            netto_total: 0,
            mwst_total: 0,
        },
        positions: [],
    },
    getters:{
        allPositions: (state) => state.positions,
        getPosition: (state, id) => state.positions[id],
        defaultPosition: (state) => state.defaultPosition,
    },
    actions: {

    },
    mutations:{
        addPosition(state){
            let newDefaultPosition =  Object.assign({}, state.defaultPosition);
            newDefaultPosition.id = state.positions.length;
            state.positions.push(newDefaultPosition);
            console.log("default", state.defaultPosition);
        },
        removePosition(state, id){

            //if only one position exists --> clear the data
            if(state.positions.length <= 1){
                state.positions = [];
                console.log("current defaultPosition", state.defaultPosition);
                this.commit("addPosition");
                return;
            }
            state.positions.splice(id, 1);
            // set id for all positions new 
            state.positions.forEach((position, index) => { 
                position.id = index;
            });
        },
        updatePosition(state, updatePos){
            state.positions[updatePos.id] = updatePos;
        }
    }
}