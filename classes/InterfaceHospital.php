<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InterfaceHospital
 *
 * @author Elias
 */
    
    class InterfaceHospital{
    
        protected $nmhospital;
        protected $telefone;
        
        function __construct() {
            $this->nmhospital = $_POST["nomehosp"];
            $this->telefone = $_POST["ddd"] . $_POST["telefone"];
        }
        
        //Funções para validação aqui
        
        public function gera(){
            
            //if(!$this->valida){ ERRO }
            
            $hosp = new Hospital();
            
            $hosp->setNmHospital($this->nmhospital);
            $hosp->setTelefone($this->telefone);
            
            return $hosp;
        }
    }
