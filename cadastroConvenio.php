<?php

    require_once 'classes/Convenio.php';
    require_once 'classes/InterfaceConvenio.php';
    require_once 'html/cadastros/administrador/cadastroconvenios.html';

    if(isset($_POST["nomeconvenio"])){
        $interf = new InterfaceConvenio();
        $convenio = $interf->gera();
        $convenio->salvaMySQL();
    }
?>