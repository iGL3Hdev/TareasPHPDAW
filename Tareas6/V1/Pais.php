<?php

    class Pais{

        private $idPais;
        
        private $NombrePais;

        function __construct($idPais, $NombrePais){
            $this->idPais = $idPais;
            $this->NombrePais = $NombrePais;
        }


        function __get($property){
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        function __set($property, $value){
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

    }

?>