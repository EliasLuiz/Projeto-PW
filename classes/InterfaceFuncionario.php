<?php

/**
 * Description of InterfaceFuncionario
 *
 * @author Elias
 */
    
    class InterfaceFuncionario{
        protected $nome;
        protected $sexo;
        protected $telefone;
        protected $cpf;
        protected $rg;
        protected $email;
        protected $login;
        protected $senha;
        protected $usuario;
        protected $cargo;
        protected $registro;
                
        function __construct() {
            $this->nome = $_POST["nome"];
            $this->sexo = $_POST["sexo"];
            $this->telefone = $_POST["ddd"] . $_POST["telefone"];
            $this->cpf = $_POST["CPF"];
            $this->rg = $_POST["RG"];
            $this->email = $_POST["email"];
            $this->login = $_POST["login"];
            $this->senha = $_POST["senha"];
            //$this->usuario = $_POST["usuario"];
            $this->cargo = $_POST["cargo"];
            $this->registro = $_POST["registro"];
        }
        
        //Funções para validação aqui
        
        public function gera(){
            
            //if(!$this->valida){ ERRO }
            
            $func = new Funcionario();
            $func->setNome($this->nome);
            $func->setSexo($this->sexo);
            $func->setTelefone($this->telefone);
            $func->setCpf($this->cpf);
            $func->setRg($this->rg);
            $func->setEmail($this->email);
            $func->setSenha($this->senha);
            $func->setCargo($this->cargo);
            $func->setRegistroFuncional($this->registro);
            
            return $func;
        }
    }
