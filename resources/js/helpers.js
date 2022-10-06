
export function toFloat(val) {
    if(val !== undefined){
        let removeDot = String(val).replace(/\./g, '');
        return parseFloat(removeDot.replace(/,/, '.'));
    }
} 
export function printCurrency(val) {
    return new Intl.NumberFormat('de-DE', { minimumFractionDigits: 2 }).format(val);
}