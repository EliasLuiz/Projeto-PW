<?php

/**
 * Classe para manipulação de TB_Cidade
 *
 * @author Elias
 */

class Cidade {
    
    protected $nome;
    
    //Set's e Get's
    public function setNome($n){
        $this->nome = $n;
    }
    public function getNome(){
        return $this->nome;
    }
    
    //Metodos de Banco de Dados
    public function carregaMySQL($cdCidade){
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Hospital no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Cidade c WHERE c.cdCidade = '" . $cdCidade . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            
            $this->nome = $result['nmCidade'];
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
        
        //Gera SQL para salvar/atualizar Hospital no banco
        $sql = "SELECT * FROM TB_Cidade c WHERE c.cdCidade = '" . $cdCidade . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Cidade c SET c.nmCidade = '" . $this->nome . "' WHERE cdCidade = " .
                   $result['cdCidade'];
        }
        else{
            $sql = "INSERT INTO TB_ClinicaHospital(cdClinicaHospital,nmClinicaHospital,telefone)" . 
                   " VALUES ('','" . $this->nmhospital . "','" . $this->telefone . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar cidade no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
}
