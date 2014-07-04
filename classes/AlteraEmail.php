<?php

/**
 * Description of AlteraEmail
 *
 * @author Daniel gatim
 */

class AlteraEmail {
    
    protected $email;
    
    //Set's e Get's
    public function setEmail($e){
        $this->email = $e;    
    }
    public function getEmail(){
        return $this->email;
    }
    
    //Métodos de Banco de Dados
    public function salvaMySQL(){
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL para atualizar Email da Pessoa no banco
        $sql = "SELECT * FROM TB_Pessoa p WHERE p.login = '" . $login .
               "' and p.senha = '" . $senha . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_Pessoa p SET p.email = '" . $this->email . "'";
        }
        else{
            die('Não foi possível carregar Pessoa do banco de dados: '.mysql_error());
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql, $con);
        if(!$result){
            die('Não foi possível salvar pessoa no banco de dados: '.mysql_error());
        }
        
        mysql_close($con);
    }
}

?>
