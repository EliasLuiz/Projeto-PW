function alfanumerico(texto){
    var Exp = /^[0-9a-z]+$/i;
    return (Exp.test(texto));
}
function alfabetico(texto){
    var Exp = /^[a-z]+$/i;
    return (Exp.test(texto));
}
function numerico(texto){
    return !(isNaN(texto));
}
function foo(){
    alert("than");
}