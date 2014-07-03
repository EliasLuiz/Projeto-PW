<?php

/**
 * Description of Cliente
 *
 * @author Elias
 */

include_once 'Pessoa.php';

class Cliente extends Pessoa {
    
    protected $rua;
    protected $numeroEnd;
    protected $complementoEnd;
    
    
    
    //Set's e Get's
    public function setRua($r){
        $this->rua = $r;
    }
    public function getRua(){
        return $this->rua;
    }
    public function setNumeroEnd($n){
        $this->numeroEnd = $n;
    }
    public function getNumeroEnd(){
        return $this->numeroEnd;
    }
    public function setComplementoEnd($c){
        $this->complementoEnd = $c;
    }
    public function getComplementoEnd(){
        return $this->complementoEnd;
    }
    
    //Métodos de Banco de Dados
    public function carregaPessoaMySQL($login, $senha){
        parent::carregaPessoaMySQL($login, $senha);
        //sql code here
    }
    public function salvaPessoaMySQL(){
        parent::salvaPessoaMySQL();
        //sql code here
    }
}

?>