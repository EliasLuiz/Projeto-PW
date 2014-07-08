    function alfanumerico(texto){
        var Exp = /^[0-9a-z]+$/i;
        return (Exp.test(texto));
    }
    function alfanumerico2(texto){
        var Exp = /^[0-9a-z]*$/i;
        return (Exp.test(texto));
    }
    function alfabetico(texto){
        var Exp = /^[a-z]+$/i;
        return (Exp.test(texto));
    }
    function numerico(texto){
        return !(isNaN(texto));
    }
    function validaEmail(texto){
        var Exp = /^[\w]+@[\w]+\.[\w|\.]+$/;
        return (Exp.test(texto));
    }
    function validaDDD(texto){
        var Exp = /^[\d]{2}$/;
        return (Exp.test(texto));
    }
    function validaTelefone(texto){
        var Exp = /^(([\d]{8})|([\d]{9}))$/;
        return (Exp.test(texto));
    }
    function validaCPF(texto){
        var Exp = /^[\d]{11}$/;
        return (Exp.test(texto));
    }
    function validaRG(texto){
        var Exp = /^([A-Z]{1}|[A-Z]{2})+([\d]{7}|[\d]{8})$/;
        return (Exp.test(texto));
    }