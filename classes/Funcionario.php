<?php

/**
 * Description of Funcionario
 *
 * @author Elias
 */

include_once 'Pessoa.php';

class Funcionario extends Pessoa{
    
    protected $registroFuncional;
    protected $cargo;
    
    //Set's e Get's
    public function setRegistroFuncional($r){
        $this->registroFuncional = $r;
    }
    public function getRegistroFuncional(){
        return $this->registroFuncional;
    }
    public function setCargo($c){
        $this->cargo = $c;
    }
    public function getCargo(){
        return $this->cargo;
    }
    
    //Métodos de Banco de Dados
    public function carregaMySQL($login, $senha){
        
        //Busca a parte de Funcionario que pertence a Pessoa no Banco
        parent::carregaMySQL($login, $senha);
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Funcionario no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Pessoa p, TB_Funcionario f WHERE p.login = '" . $login .
               "' and p.senha = '" . $senha . "' and p.cdPessoa = f.cdPessoa";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $this->registroFuncional = $result['registroFuncional'];
            $this->cargo = $result['cargo'];
        }
        else{
            die('Não foi possível carregar funcionario do banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
    public function salvaMySQL(){
        
        //Salva a parte de Funcionario que pertence a Pessoa no banco
        parent::salvaMySQL();
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL para salvar/atualizar Funcionario no banco
        $sql = "SELECT * FROM TB_Pessoa p, TB_Funcionario f WHERE p.login = '" . $this->login .
               "' and p.senha = '" . $this->senha . "' and p.cdPessoa = f.cdPessoa";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Funcionario SET registroFuncional = '" . $this->registroFuncional .
                   "', cargo = '" . $this->cargo . "' WHERE cdPessoa = " . $result['cdPessoa'];
        }
        else{
            $sql = "SELECT * FROM TB_Pessoa p WHERE p.login = '" . $this->login .
               "' and p.senha = '" . $this->senha . "'";
            $result = mysql_query($sql, $con);
            
            if(!$result){
                die('Não foi possível carregar pessoa do banco de dados: '.mysql_error());
            }
            
            $sql = "INSERT INTO TB_Funcionario(cdPessoa, registroFuncional, cargo) VALUES (" .
                   $result['cdPessoa'] . ",'" . $this->registroFuncional . "','" . $this->cargo . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar funcionario no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
}

?>