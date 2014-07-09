<?php

    require_once 'classes/Cliente.php';
    require_once 'classes/Medico.php';   
    require_once 'classes/Bairro.php';  
    require_once 'classes/InterfaceUsuario.php';
    require_once 'html/cadastros/cadastrocliente/cadastrocliente.html';
    
    if(isset($_POST["usuario"])){
        $interf = new InterfaceUsuario();
        $user = $interf->gera();
        $user->salvaMySQL();
    }

?>