<?php

    require_once 'classes/Pessoa.php';

    require_once 'html/cadastros/configuracoes/alterasenha.html';
    
    //criar classe de interface depois

    if(isset($_POST["senha"])){
        $cdPessoa = $_COOKIE["cd"];
        $pessoa = new Pessoa();
        if($pessoa->getSenha() == $_POST["senha"]){
            $pessoa->carregaMySQL($cdPessoa);
            $pessoa->setSenha($_POST["senha2"]);
            $pessoa->salvaMySQL();
        }
    }

?>