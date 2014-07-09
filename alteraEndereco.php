<?php

    include_once 'classes/Cliente.php';
    include_once 'classes/Bairro.php';

    require_once 'html/cadastros/configuracoes/alteraendereco.html';
    
    if(isset($_POST["rua"])){
        $cdCliente = $_COOKIE["cd"];
        $cliente = new Cliente();
        $cliente->carregaMySQL($cdCliente);
        $cliente->setRua($_POST["rua"]);
        $cliente->setNumeroEnd($_POST["numero"]);
        $cliente->setComplementoEnd($_POST["complemento"]);
        $bairro = new Bairro();
        
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        $sql = "SELECT * FROM TB_Bairro b, TB_Cidade c WHERE b.nmBairro = '" . $_POST["bairro"] . "' and "
               . "c.cdCidade = b.cdCidade and c.nmCidade = '" . $_POST["cidade"] . "'";
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível carregar bairro do banco de dados: '.mysql_error());
        }
        $result = mysql_fetch_array($result);
        mysql_close($con);
        
        $bairro->carregaMySQL($result["cdBairro"]);
        $cliente->setBairro($bairro);
        $cliente->salvaMySQL();
    }

?>