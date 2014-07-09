<?php

/**
 * Description of InterfaceConvenio
 *
 * @author Elias
 */

    
    class InterfaceConvenio{
        protected $nome;
        protected $responsavel;
        
        function __construct() {
            $this->nome = $_POST["nomeconvenio"];
            $this->responsavel = $_POST["responsavel"];
        }
        
        //Funções para validação aqui
        
        public function gera(){
            
            //if(!$this->valida){ ERRO }
            
            $convenio = new Convenio();
            
            $convenio->setNome($this->nome);
            $convenio->setResponsavel($this->responsavel);
            
            return $convenio;
        }
    }
