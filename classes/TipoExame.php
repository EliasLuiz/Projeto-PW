<?php

/**
 * Description of Exame
 *
 * @author Daniel gatim
 */

class TipoExame {
    
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
    public function carregaMySQL($cdExame){
        
        //Estabelece conexão
        $con = mysql_connect("localhost","root","") or die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        mysql_select_db('mydb') or die('Não foi possível selecionar o banco' . mysql_error());
        
        //Gera SQL e busca Exame no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_TipoExame t WHERE t.cdTipoExame = '" . $cdExame . "'";
        $result = mysql_query($sql, $con) or die('Não foi possível carregar TipoExame do banco de dados: '.mysql_error());
            $result = mysql_fetch_array($result);
            
            $this->nome = $result['nmTipoExame'];
            $this->coletadomicilio = $result['coletaDomicilio'];
            $this->requisitos = $result['requisitos'];
            $this->info = $result['informacoes'];
            $this->preco = $result['preco'];
        
        mysql_close($con);
    }
    public function salvaMySQL(){
        //Estabelece conexão
        $con = mysql_connect("localhost","root","") or die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        mysql_select_db('mydb') or die('Não foi possível selecionar o banco' . mysql_error());
        
        //Gera SQL para salvar/atualizar Exame no banco
        $sql = "SELECT * FROM TB_TipoExame t WHERE t.nmTipoExame = '" . $this->nome . "'";
        $result = mysql_query($sql) or die('Não foi possível buscar TipoExame no banco de dados: '.mysql_error());
        $result = mysql_fetch_array($result);
        if($result["nmTipoExame"]==$this->nome){
            $sql = "UPDATE TB_TipoExame t SET t.nmTipoExame = '" . $this->nome .
                   "', t.coletaDomicilio = '" . $this->coletadomicilio . "', t.requisitos = '" . $this->requisitos .
                   "', t.informacoes = '" . $this->info . "', t.preco = " . $this->preco . " WHERE"
                    . " cdTipoExame = " . $result["cdTipoExame"];
        }
        else{
            $sql = "INSERT INTO TB_TipoExame(cdTipoExame,nmTipoExame,coletaDomicilio,requisitos,informacoes,preco)" . 
                   " VALUES ('','" . $this->nome . "','" . $this->coletadomicilio . "','" . $this->requisitos . "','" . 
                   $this->info . "','" . $this->preco . "')";
        }
        
        //Executa SQL e testa sucesso
        $result = mysql_query($sql,$con) or die('Não foi possível salvar TipoExame no banco de dados: '.mysql_error());
        
        mysql_close($con);
    }
}

?>