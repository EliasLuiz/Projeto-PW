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
        $con = mysql_connect("localhost","root","") or die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        mysql_select_db('mydb') or die('Não foi possível selecionar o banco' . mysql_error());
        
        //Gera SQL e busca Convenio no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_Convenio c WHERE c.cdConvenio = '" . $this->nome . "'";
        $result = mysql_query($sql, $con) or die('Não foi possível carregar Convenio do banco de dados: '.mysql_error());
        $result = mysql_fetch_array($result);
        $this->nome = $result['nmConvenio'];
        $this->responsavel = $result['responsavel'];
        
        mysql_close($con);
    }
    public function salvaMySQL(){
        //Estabelece conexão
        $con = mysql_connect("localhost","root","") or die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());

        mysql_select_db('mydb') or die('falha ao selecionar o banco');
        
        //Gera SQL para salvar/atualizar Pessoa no banco
        $sql = "SELECT * FROM TB_Convenio c WHERE c.nmConvenio = '" . $this->nome . "'";
        //$result = mysqli_query($con, $sql);
        $result = mysql_query($sql) or die($this->nome);
        $result = mysql_fetch_array($result);
        if($result["nmConvenio"]==$this->nome){
            $sql = "UPDATE TB_Convenio c SET c.nmConvenio = '" . $this->nome .
                   "', c.responsavel = '" . $this->responsavel . "' WHERE"
                    . " cdConvenio = " . $result["cdConvenio"];
        }
        else{
            $sql = "INSERT INTO TB_Convenio(cdConvenio,nmConvenio,responsavel)" . 
                   " VALUES ('','" . $this->nome . "','" . $this->responsavel . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql,$con) or die('Não foi possível salvar Convenio no banco de dados: '.mysql_error());
        
        mysql_close($con);
    }
}

?>