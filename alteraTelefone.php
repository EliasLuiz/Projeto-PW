<?php

    require_once 'Pessoa.php';

    require_once 'html/cadastros/configuracoes/alteratelefone.html';
    
    //criar classe de interface depois
    
    if(isset($_POST["ddd"])){
        $cdPessoa = $_COOKIE["cd"];
        $pessoa = new Pessoa();
        $pessoa->carregaMySQL($cdPessoa);
        $pessoa->setTelefone($_POST["ddd"] . $_POST["telefone"]);
        $pessoa->salvaMySQL();
    }

?>