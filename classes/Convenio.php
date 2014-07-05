<?php

/**
 * Description of Convenio
 *
 * @author Daniel
 */

class Convenio {
    
    protected $nome;
    protected $responsavel;
    
    //Set's e Get's
    public function setNome($n){
        $this->nome = $n;    
    }
    public function getNome(){
        return $this->nome;
    }
    public function setResponsavel($r){
        $this->responsavel = $r;
    }
    public function getResponsavel(){
        return $this->responsavel;
    }
    
    //Métodos de Banco de Dados
    public function carregaMySQL($cdConvenio){
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Convenio no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Convenio c WHERE c.cdConvenio = '" . $cdConvenio . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            
            $this->nome = $result['nmConvenio'];
            $this->responsavel = $result['responsavel'];
        }
        else{
            die('Não foi possível carregar Convenio do banco de dados: '.mysql_error());
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
        
        //Gera SQL para salvar/atualizar Pessoa no banco
        $sql = "SELECT * FROM TB_Convenio c WHERE c.cdConvenio = '" . $cdConvenio . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Convenio c SET c.nmConvenio = '" . $this->nome .
                   "', c.responsavel = '" . $this->responsavel . "'";
        }
        else{
            $sql = "INSERT INTO TB_Convenio(cdConvenio,nmConvenio,responsavel)" . 
                   " VALUES ('','" . $this->nome . "','" . $this->responsavel . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar Convenio no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
}

?>