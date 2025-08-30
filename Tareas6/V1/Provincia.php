<?php

    class Provincia implements JsonSerializable{

        private $idProvincia;
        
        private $NombreProvincia;

        private $idPais;

        function __construct($idProvincia, $NombreProvincia, $idPais){
            $this->idProvincia = $idProvincia;
            $this->NombreProvincia = $NombreProvincia;
            $this->idPais = $idPais;
        }

        public function __get($property){
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        public function __set($property, $value){
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        public function jsonSerialize(): mixed {
             return array(
                'idProvincia' => $this->idProvincia,
                'nombreProvincia' => $this->NombreProvincia,
                'idPais' => $this->idPais
            );
        }

    }

?>