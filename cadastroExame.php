<?php

    require_once 'classes/TipoExame.php';
    require_once 'classes/InterfaceTipoExame.php';
    require_once 'html/cadastros/administrador/cadastroexame.html';

    if(isset($_POST["nomeexame"])){
        $interf = new InterfaceTipoExame();
        $texame = $interf->gera();
        $texame->salvaMySQL();
    }
    
?>