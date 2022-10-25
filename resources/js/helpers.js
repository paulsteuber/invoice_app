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

export function dateToInputFormat(date,daysLater){
    const dateObj = new Date(date);
    daysLater = daysLater === undefined? 0 : daysLater;
    const newDate = new Date(dateObj.getTime() + (daysLater * 24 * 60 * 60 * 1000));

    console.log("xx", newDate);
    const year = newDate.getFullYear();
    let month = newDate.getMonth()+1;
    month = month < 10 ? '0'+month: ''+month;
    let day = newDate.getDate();
    day = day < 10 ? '0'+day: ''+day;
    console.log("newDate", year+"-"+month+"-"+day);
    return year+"-"+month+"-"+day;
}