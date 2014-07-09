<?php

    include_once 'Convenio.php';

    require_once 'html/cadastros/administrador/cadastroconvenios.html';

    if(isset($_POST["nomeconvenio"])){
        $interf = new InterfaceConvenio();
        $convenio = $interf->gera();
        $convenio->salvaMySQL();
    }
    
    class InterfaceUsuario{
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
?>