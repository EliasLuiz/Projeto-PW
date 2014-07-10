<?php

/**
 * Description of InterfaceExame
 *
 * @author Elias
 */
    
    class InterfaceTipoExame{
    
        protected $nome;
        protected $coletadomicilio;
        protected $requisitos;
        protected $info;
        protected $preco;
        
        function __construct() {
            $this->nome = $_POST["nomeexame"];
            $this->coletadomicilio = $_POST["domicilio"]=="domicilio";
            $this->requisitos = $_POST["requisitos"];
            $this->info = $_POST["informacoes"];
            $this->preco = $_POST["preco"];
        }
        
        //Funções para validação aqui
        
        public function gera(){
            
            //if(!$this->valida){ ERRO }
            
            $texame = new TipoExame();
            
            $texame->setNome($this->nome);
            $texame->setColetaDomicilio($this->coletadomicilio);
            $texame->setrequisitos($this->requisitos);
            $texame->setInfo($this->info);
            $texame->setPreco($this->preco);
            
            return $texame;
        }
    }