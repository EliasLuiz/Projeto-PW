<?php

    require_once 'classes/Hospital.php';
    require_once 'classes/InterfaceHospital.php';
    require_once 'html/cadastros/administrador/cadastrohospitais.html';

    if(isset($_POST["nomehosp"])){
        $interf = new InterfaceHospital();
        $hospital = $interf->gera();
        $hospital->salvaMySQL();
    }
?>