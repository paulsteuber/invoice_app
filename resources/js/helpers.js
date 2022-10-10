
export function toFloat(val) {
    if(val !== undefined){
        let removeDot = String(val).replace(/\./g, '');
        return parseFloat(removeDot.replace(/,/, '.'));
    }
} 
export function printCurrency(val) {
    return new Intl.NumberFormat('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(val);
}
export function addBracketsToArrayString(val){
    if(String(val)[0] !== "["){
        return "["+val+"]";
    }
    return val;
    
}
export function parseToJsonArray(val) {
    const uniqueDivider = "#"
    const addDivider = String(val).replace("}{", "}"+uniqueDivider+"{");
    const json = JSON.parse("["+String(addDivider.split(uniqueDivider)+"]"));
    return json;
} 

export function splitDateString(dateString){
    const splitted = dateString.split("-");
    return new Date(splitted[0],splitted[1],splitted[2])
}
export function dateToString(date){
    return date.getDate().toString().padStart(2, "0")+"."+date.getMonth().toString().padStart(2, "0")+"."+date.getFullYear();
}