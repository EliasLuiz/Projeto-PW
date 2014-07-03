<?php

/**
 * Description of Medico
 *
 * @author Elias
 */

include_once 'Pessoa.php';

class Medico extends Pessoa{
    
    protected $crm;
    
    
    
    //Set's e Get's
    public function setCrm($c){
        $this->crm = $c;
    }
    public function getCrm(){
        return $this->crm;
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