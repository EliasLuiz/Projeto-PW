<?php

/**
 * Classe para manipulação de TB_Bairro
 *
 * @author Elias
 */

include_once 'Cidade.php';

class Bairro {
    
    protected $nome;
    protected $cidade;
    
    //Construtor
    function __construct() {
        $this->cidade = new Cidade();
    }
    
    //Set's e Get's
    public function setNome($n){
        $this->nome = $n;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setCidade($c){
        $this->cidade = $c;
    }
    public function getCidade(){
        return $this->cidade;
    }
    
    //Metodos de Banco de Dados
    public function carregaMySQL($cdBairro){
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Bairro no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Bairro b, TB_Cidade c WHERE b.cdBairro = '" . $cdBairro . "' and "
               . "b.cdCidade = c.cdCidade";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            
            $this->nome = $result['nmBairro'];
            $this->cidade->setNome($result['nmCidade']);
        }
        else{
            die('Não foi possível carregar cidade do banco de dados: '.mysql_error());
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
        
        //Gera SQL para salvar/atualizar Bairro no banco
        $sql = "SELECT * FROM TB_Bairro b, TB_Cidade c WHERE b.nmBairro = '" . $this->nome . "' and "
               . "c.cdCidade = b.cdCidade and c.nmCidade = '" . $this->cidade->getNome() . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Bairro SET nmBairro = '" . $this->nome . "' WHERE cdBairro = " .
                   $result['cdBairro'];
        }
        else{
            $sql = "SELECT * FROM TB_Cidade WHERE nmCidade = '" . $this->cidade->getNome() . "'";
            $result = mysql_query($sql, $con);
            
            if(!$result){
                die('Não foi possível carregar cidade do banco de dados: '.mysql_error());
            }
            
            $sql = "INSERT INTO TB_Bairro(cdBairro,nmBairro,cdCidade)" . 
                   " VALUES ('','" . $this->nome . "','" . $result['cdCidade'] . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar cidade no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
    
}
