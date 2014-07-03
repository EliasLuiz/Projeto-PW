<?php

/**
 * Description of Pessoa
 *
 * @author Elias
 */

class Pessoa {
    
    protected $nome;
    protected $cpf;
    protected $rg;
    protected $login;
    protected $senha;
    protected $sexo;
    protected $telefone;
    protected $email;
    
    
    
    //Set's e Get's
    public function setNome($n){
        $this->nome = $n;    
    }
    public function getNome(){
        return $this->nome;
    }
    public function setCpf($c){
        $this->cpf = $c;
    }
    public function getCpf(){
        return $this->cpf;
    }
    public function setRg($r){
        $this->rg = $r;
    }
    public function getRg(){
        return $this->rg;
    }
    public function setLogin($l){
        $this->login = $l;
    }
    public function getLogin(){
        return $this->login;
    }
    public function setSenha($s){
        $this->senha = $s;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSexo($s){
        $this->sexo = $s;
    }
    public function getSexo(){
        return $this->sexo;
    }
    public function setTelefone($t){
        $this->telefone = $t;
    }
    public function getTelefone(){
        return $this->telefone;
    }
    public function setEmail($e){
        $this->email = $e;
    }
    public function getEmail(){
        return $this->email;
    }
    
    //Métodos de Banco de Dados
    public function carregaPessoaMySQL($login, $senha){
        //sql code here
    }
    public function salvaPessoaMySQL(){
        //sql code here
    }
}

?>