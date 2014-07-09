<?php

    include_once 'classes/Pessoa.php';

    require_once 'html/cadastros/configuracoes/alteraemail.html';
    
    //criar classe de interface depois
    
    if(isset($_POST["email"])){
        $cdPessoa = $_COOKIE["cd"];
        $pessoa = new Pessoa();
        $pessoa->carregaMySQL($cdPessoa);
        $pessoa->setEmail($_POST["email"]);
        $pessoa->salvaMySQL();
    }
    
?>