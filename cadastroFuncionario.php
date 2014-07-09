<?php

    require_once 'classes/Funcionario.php';
    require_once 'classes/InterfaceFuncionario.php';
    require_once 'html/cadastros/administrador/cadastrofuncionario.html';

    if(isset($_POST["nome"])){
        $interf = new InterfaceFuncionario();
        $func = $interf->gera();
        $func->salvaMySQL();
    }
    
?>