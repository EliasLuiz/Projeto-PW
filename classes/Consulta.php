<?php

/**
 * Description of Consulta
 *
 * @author Daniel
 */

include_once 'Cliente.php';
include_once 'Medico.php';

class Consulta {
    
    protected $data;
    protected $cliente;
    protected $medico;

    //Construtor
    function __construct() {
        $this->cliente = new Cliente();
        $this->medico = new Medico();
    }


    //Set's e Get's
    public function setData($d){
        $this->data = $d;    
    }
    public function getData(){
        return $this->data;
    }
    public function setCliente($c){
        $this->cliente = $c;    
    }
    public function getCliente(){
        return $this->cliente;
    }
    public function setMedico($m){
        $this->medico = $m;    
    }
    public function getMedico(){
        return $this->medico;
    }
    
    //Métodos de Banco de Dados
    public function carregaMySQL($cdConsulta){
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Consulta no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Consulta c WHERE c.cdConsulta = '" . $cdConsulta . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            
            $this->data = $result['dtConsulta'];
            $this->cliente->carregaMySQL($result['cdCliente']);
            $this->medico->carregaMySQL($result['cdMedico']);
        }
        else{
            die('Não foi possível carregar Consulta do banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
    public function salvaMySQL(){
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL para salvar/atualizar Consulta no banco
        
        //Busca cdCliente
        $sql = "SELECT * FROM TB_Pessoa p WHERE p.login = '" . $this->cliente->getLogin() . "'";
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível carregar pessoa do banco de dados: '.mysql_error());
        }        
        $result = mysql_fetch_array($result);
        $cdCliente = $result['cdPessoa'];
        //Busca cdMedico
        $sql = "SELECT * FROM TB_Pessoa p WHERE p.login = '" . $this->medico->getLogin() . "'";
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível carregar pessoa do banco de dados: '.mysql_error());
        }        
        $result = mysql_fetch_array($result);
        $cdMedico = $result['cdPessoa'];
        //Gera SQL e salva consulta
        $sql = "SELECT * FROM TB_Consulta WHERE cdCliente = " . $cdCliente . " and cdMedico = "
               . $cdMedico . " and dtConsulta = '" . $this->data . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Consulta c SET c.dtConsulta = '" . $this->data . "'";
        }
        else{
            $sql = "INSERT INTO TB_Consulta(cdConsulta, cdCliente, cdMedico, dtConsulta) VALUES"
                   . "(''," . $cdCliente . ", " . $cdMedico . ", '" . $this->data . "'";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar Consulta no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
}

?>