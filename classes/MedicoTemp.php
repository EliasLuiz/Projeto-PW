<?php

/**
 * Description of MedicoTemp
 *
 * @author Daniel
 */

class MedicoTemp {
    
    protected $nome;
    protected $crm;
    
    //Set's e Get's
    public function setNome($n){
        $this->nome = $n;    
    }
    public function getNome(){
        return $this->nome;
    }
    public function setCRM($c){
        $this->crm = $c;
    }
    public function getCRM(){
        return $this->crm;
    }
    
    //Métodos de Banco de Dados
    public function carregaMySQL($crm){
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca MedicoTemp no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Medico_temp m WHERE m.crm = '" . $crm . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            
            $this->nome = $result['nmMedico'];
            $this->crm = $result['crm'];
        }
        else{
            die('Não foi possível carregar MedicoTemp do banco de dados: '.mysql_error());
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
        
        //Gera SQL para salvar/atualizar MedicoTemp no banco
        $sql = "SELECT * FROM TB_Medico_temp m WHERE m.crm = '" . $crm . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Medico_temp m SET m.nmMedico = '" . $this->nome .
                   "', m.crm = '" . $this->crm . "'";
        }
        else{
            $sql = "INSERT INTO TB_Medico_temp(cdMedico_temp,nmMedico,crm)" . 
                   " VALUES ('','" . $this->nome . "','" . $this->crm . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar Medico_temp no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
}

?>
