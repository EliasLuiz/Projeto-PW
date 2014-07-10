<?php

    require_once 'classes/Cliente.php';

    require_once 'html/cadastros/configuracoes/alteramedicamento.html';
    
    //criar classe de interface depois

    if(isset($_POST["medicamentos"])){
        $cdPessoa = $_COOKIE["cd"];
        $pessoa = new Cliente();
        $pessoa->carregaMySQL($cdPessoa);
        $pessoa->setMedicamentos($_POST["medicamentos"]);
        $pessoa->salvaMySQL();
    }
    
    
?>