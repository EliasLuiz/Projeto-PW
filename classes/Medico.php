<?php

/**
 * Description of Medico
 *
 * @author Elias
 */

include_once 'Pessoa.php';

class Medico extends Pessoa{
    
    protected $crm;
    
    //Set's e Get's
    public function setCrm($c){
        $this->crm = $c;
    }
    public function getCrm(){
        return $this->crm;
    }
    
    //Métodos de Banco de Dados
    public function carregaMySQL($cdMedico){
        
        //Busca a parte de Medico que pertence a Pessoa no Banco
        parent::carregaMySQL($cdMedico);
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Medico no banco, carregando se não houver erro
        $sql = "SELECT * TB_Medico WHERE cdPessoa = " . $cdMedico;
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $this->crm = $result['crm'];
        }
        else{
            die('Não foi possível carregar medico do banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
    public function salvaMySQL(){
        
        //Salva a parte de Medico que pertence a Pessoa no banco
        parent::salvaMySQL();
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL para salvar/atualizar Medico no banco
        $sql = "SELECT * FROM TB_Pessoa p, TB_Medico m WHERE p.login = '" . $this->login .
               "' and p.senha = '" . $this->senha . "' and p.cdPessoa = m.cdPessoa";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Medico SET crm = '" . $this->crm .
                   "' WHERE cdPessoa = " . $result['cdPessoa'];
        }
        else{
            $sql = "SELECT * FROM TB_Pessoa p WHERE p.login = '" . $this->login .
               "' and p.senha = '" . $this->senha . "'";
            $result = mysql_query($sql, $con);
            
            if(!$result){
                die('Não foi possível carregar pessoa do banco de dados: '.mysql_error());
            }
            
            $sql = "INSERT INTO TB_Medico(cdPessoa, crm) VALUES (" .
                   $result['cdPessoa'] . ",'" . $this->crm . "')";
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