<?php

/**
 * Description of Mensagem
 *
 * @author Daniel
 */

include_once 'Cliente.php';
include_once 'Medico.php';

class Mensagem {
    
    protected $texto;
    protected $data;
    protected $cliente;
    protected $medico;


    //Set's e Get's
    public function setTexto($t){
        $this->texto = $t;    
    }
    public function getTexto(){
        return $this->texto;
    }
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
 
    //Construtor
    function __construct() {
        $this->cliente = new Cliente();
        $this->medico = new Medico();
    }


    //Métodos de Banco de Dados
    public function carregaMySQL($cdMensagem){
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Mensagem no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Mensagem m WHERE m.cdMensagem = '" . $cdMensagem . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            
            $this->texto = $result['txtMensagem'];
            $this->data = $result['dtMensagem'];
            $this->cliente->carregaMySQL($result['cdCliente']);
            $this->medico->carregaMySQL($result['cdMedico']);
        }
        else{
            die('Não foi possível carregar Mensagem do banco de dados: '.mysql_error());
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
        
        //busca cdcliente
        $sql = "SELECT * FROM TB_Cliente c, TB_Pessoa WHERE p.cdPessoa = c.cdPessoa and"
               . " p.login = '" . $this->cliente->getLogin() . "'";
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível carregar cliente do banco de dados: '.mysql_error());
        }
        $result = mysql_fetch_array($result);
        $cdCliente = $result['cdPessoa'];
        
        //busca cdmedico
        $sql = "SELECT * FROM TB_Medico m, TB_Pessoa WHERE p.cdPessoa = m.cdPessoa and"
               . " p.login = '" . $this->medico->getLogin() . "'";
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível carregar medico do banco de dados: '.mysql_error());
        }
        $result = mysql_fetch_array($result);
        $cdMedico = $result['cdPessoa'];
        
        //Gera SQL para salvar/atualizar Mensagem no banco
        $sql = "SELECT * FROM TB_Mensagem m WHERE m.cdCliente = " . $cdCliente . " and m.cdMedico = "
                . $cdMedico . " and txtMensagem = '" . $this->texto . "' and dtMensagem = '" .
                $this->data . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Mensagem m SET m.txtMensagem = '" . $this->texto .
                   "', m.dtMensagem = '" . $this->data . "' WHERE cdMensagem = ". $result['cdMensagem'];
        }
        else{
            //insert into
            $sql = "INSERT INTO TB_Mensagem(cdMensagem, cdCliente, cdMedico, txtMensagem, dtMensagem)"
                   . "VALUES ('', " . $cdCliente . ", " . $cdMedico . ", '" . $this->texto . "', '" . 
                   $this->data . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar Mensagem no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
}

?>