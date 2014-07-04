<?php

/**
 * Description of Exame
 *
 * @author Daniel gatim
 */

class Exame {
    
    protected $nome;
    protected $coletadomicilio;
    protected $requisitos;
    protected $info;
    protected $preco;
    
    //Set's e Get's
    public function setNome($n){
        $this->nome = $n;    
    }
    public function getNome(){
        return $this->nome;
    }
    public function setColetaDomicilio($c){
        $this->coletadomicilio = $c;
    }
    public function getColetaDomicilio(){
        return $this->coletadomicilio;
    }
    public function setrequisitos($r){
        $this->requisitos = $r;
    }
    public function getRequisitos(){
        return $this->requisitos;
    }
    public function setInfo($i){
        $this->info = $i;
    }
    public function getInfo(){
        return $this->info;
    }
    public function setPreco($p){
        $this->preco = $p;
    }
    public function getPreco(){
        return $this->preco;
    }
    
    //Métodos de Banco de Dados
    public function carregaMySQL($login, $senha){
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Exame no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_TipoExame t WHERE t.login = '" . $login .
               "' and t.senha = '" . $senha . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            
            $this->nome = $result['nmTipoExame'];
            $this->coletadomicilio = $result['coletaDomicilio'];
            $this->requisitos = $result['requisitos'];
            $this->info = $result['informacoes'];
            $this->preco = $result['preco'];
        }
        else{
            die('Não foi possível carregar pessoa do banco de dados: '.mysql_error());
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
        
        //Gera SQL para salvar/atualizar Exame no banco
        $sql = "SELECT * FROM TB_TipoExame t WHERE t.login = '" . $login .
               "' and t.senha = '" . $senha . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_TipoExame t SET t.nmTipoExame = '" . $this->nome .
                   "', t.coletaDomicilio = '" . $this->coletadomicilio . "', t.requisitos = '" . $this->requisitos .
                   "', t.informacoes = '" . $this->info . "', t.preco = '" . $this->preco . "'";
        }
        else{
            $sql = "INSERT INTO TB_TipoExame(cdExame,nmTipoExame,coletaDomicilio,requisitos,informacoes,preco)" . 
                   " VALUES ('','" . $this->nome . "','" . $this->coletadomicilio . "','" . $this->requisitos . "','" . 
                   $this->info . "','" . $this->preco . "')";
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