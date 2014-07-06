<?php

/**
 * Description of Cliente
 *
 * @author Elias
 */

include_once 'Pessoa.php';
include_once 'Bairro.php';

class Cliente extends Pessoa {
    
    protected $rua;
    protected $numeroEnd;
    protected $complementoEnd;
    protected $medicamentos;
    protected $bairro;
    
    //Construtor
    function __construct() {
        $this->bairro = new Bairro();
    }

    //Set's e Get's
    public function setRua($r){
        $this->rua = $r;
    }
    public function getRua(){
        return $this->rua;
    }
    public function setNumeroEnd($n){
        $this->numeroEnd = $n;
    }
    public function getNumeroEnd(){
        return $this->numeroEnd;
    }
    public function setComplementoEnd($c){
        $this->complementoEnd = $c;
    }
    public function getComplementoEnd(){
        return $this->complementoEnd;
    }
    public function setMedicamentos($m){
        $this->medicamentos = m;
    }
    public function getMedicamentos(){
        return $this->medicamentos;
    }
    public function setBairro($b){
        $this->bairro = $b;
    }
    public function getBairro(){
        return $this->bairro;
    }

        //Métodos de Banco de Dados
    public function carregaMySQL($cdCliente){
        
        //Busca a parte de Cliente que pertence a Pessoa no Banco
        parent::carregaMySQL($cdCliente);
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Cliente no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Cliente WHERE cdPessoa = " . $cdCliente;
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $this->rua = $result['rua'];
            $this->numeroEnd = $result['numeroEnd'];
            $this->complementoEnd = $result['complementoEnd'];
            $this->medicamentos = $result['medicamentos'];
            $this->bairro->carregaMySQL($result['cdBairro']);
        }
        else{
            die('Não foi possível carregar cliente do banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
    public function salvaMySQL(){
        
        //Salva a parte de Cliente que pertence a Pessoa no banco
        parent::salvaMySQL();
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL para salvar/atualizar Cliente no banco
        $sql = "SELECT * FROM TB_Pessoa p, TB_Cliente c WHERE p.login = '" . $this->login .
               "' and p.senha = '" . $this->senha . "' and p.cdPessoa = c.cdPessoa";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Cliente SET rua = '" . $this->rua .
                   "', numeroEnd = " . $this->numeroEnd . ", complementoEnd = '".
                   $this->complementoEnd . "', medicamentos = '" . $this->medicamentos .
                   "' WHERE cdPessoa = " . $result['cdPessoa'];
        }
        else{
            //Busca chave de pessoa e de bairro para inserir em cliente
            $sql = "SELECT * FROM TB_Pessoa p, TB_Bairro b WHERE p.login = '" . $this->login .
               "' and p.senha = '" . $this->senha . "' and b.cdBairro = " . $this->bairro->getCdBairro();
            $result = mysql_query($sql, $con);
            
            if(!$result){
                die('Não foi possível carregar pessoa do banco de dados: '.mysql_error());
            }
            
            $result = mysql_fetch_array($result);
            $sql = "INSERT INTO TB_Cliente(cdPessoa, cdBairro, rua, numeroEnd, complementoEnd, medicamentos) "
                   . "VALUES (" . $result['cdPessoa'] . ",". $result['cdBairro'] . ",'" . $this->rua . "','" .
                   $this->numeroEnd . "','" . $this->complementoEnd . "','" . $this->medicamentos . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar medico no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
}

?>