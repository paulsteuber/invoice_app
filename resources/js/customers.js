function sameHeight(className){
    let objects = document.getElementsByClassName(className);
    let maxHeight = 0;
    
    if(objects.length){
        for(let obj of objects){
            let height = obj.offsetHeight;
            maxHeight = height > maxHeight ? height : maxHeight;
        }
    }
    console.log(maxHeight);
    for(let obj of objects){
        obj.style.height = maxHeight+"px";
    }
    
    
}
document.addEventListener("DOMContentLoaded", function(e) {
    let customerCards = document.getElementsByClassName("customer-card-header");   
    sameHeight("customer-card-header");
});