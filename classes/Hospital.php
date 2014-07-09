<?php

/**
 * Description of Hospital
 *
 * @author Daniel gatim
 */

class Hospital {
    
    protected $nmhospital;
    protected $telefone;
    
    //Set's e Get's
    public function setNmHospital($n){
        $this->nmhospital = $n;    
    }
    public function getNmHospital(){
        return $this->nmhospital;
    }
    public function setTelefone($t){
        $this->telefone = $t;
    }
    public function getTelefone(){
        return $this->telefone;
    }
    
    //Métodos de Banco de Dados
    public function carregaMySQL($cdClinicaHospital){
        
        //Estabelece conexão
        $con = mysql_connect("localhost:3306","root","");
        if(!$con){
            die('Não foi possível estabelecer conexão com o banco de dados: '.mysql_error());
        }
        mysql_select_db("mydb", $con);
        
        //Gera SQL e busca Hospital no banco, carregando se não houver erro
        $sql = "SELECT * FROM TB_ClinicaHospital c WHERE c.cdClinicaHospital = '" . $cdClinicaHospital . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            
            $this->nmhospital = $result['nmClinicaHospital'];
            $this->telefone = $result['telefone'];
        }
        else{
            die('Não foi possível carregar hospital do banco de dados: '.mysql_error());
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
        $sql = "SELECT * FROM TB_ClinicaHospital c WHERE c.cdClinicaHospital = '" . $cdClinicaHospital . "'";
        $result = mysql_query($sql, $con);
        if($result){
            $result = mysql_fetch_array($result);
            $sql = "UPDATE TB_ClinicaHospital c SET c.nmClinicaHospital = '" . $this->nmhospital .
                   "', c.telefone = '" . $this->telefone . "' WHERE c.cdClinicaHospital = " .
                   $result['cdClinicaHospital'];
        }
        else{
            $sql = "INSERT INTO TB_ClinicaHospital(cdClinicaHospital,nmClinicaHospital,telefone)" . 
                   " VALUES ('','" . $this->nmhospital . "','" . $this->telefone . "')";
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