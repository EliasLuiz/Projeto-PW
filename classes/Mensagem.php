<?php

/**
 * Description of Mensagem
 *
 * @author Daniel
 */

class Mensagem {
    
    protected $texto;
    protected $data;
    
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
        }
        else{
            die('Não foi possível carregar Mensagem do banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
    public function salvaMySQL($cdMensagem){
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL para salvar/atualizar Mensagem no banco
        $sql = "SELECT * FROM TB_Mensagem m WHERE m.cdMensagem = '" . $cdMensagem . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Mensagem m SET m.txtMensagem = '" . $this->texto .
                   "', m.dtMensagem = '" . $this->data . "'";
        }
        else{
            //DUVIDA??????
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