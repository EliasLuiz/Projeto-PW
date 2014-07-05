<?php

/**
 * Description of Consulta
 *
 * @author Daniel
 */

class Consulta {
    
    protected $dtConsulta;
    
    //Set's e Get's
    public function setDtConsulta($d){
        $this->dtConsulta = $d;    
    }
    public function getDtConsulta(){
        return $this->dtConsulta;
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
            
            $this->dtConsulta = $result['dtConsulta'];
        }
        else{
            die('Não foi possível carregar Consulta do banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
    public function salvaMySQL($cdConsulta){
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL para salvar/atualizar Consulta no banco
        $sql = "SELECT * FROM TB_Consulta c WHERE c.cdConsulta = '" . $cdConsulta . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Consulta c SET c.dtConsulta = '" . $this->dtConsulta . "'";
        }
        else{
            //DUVIDA??????
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