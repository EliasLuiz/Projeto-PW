<?php

/**
 * Description of Funcionario
 *
 * @author Elias
 */

include_once 'Pessoa.php';

class Funcionario extends Pessoa{
    
    protected $registroFuncional;
    protected $cargo;
    
    
    
    //Set's e Get's
    public function setRegistroFuncional($r){
        $this->registroFuncional = $r;
    }
    public function getRegistroFuncional(){
        return $this->registroFuncional;
    }
    public function setCargo($c){
        $this->cargo = $c;
    }
    public function getCargo(){
        return $this->cargo;
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
