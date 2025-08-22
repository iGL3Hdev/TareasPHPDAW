<?php

    class CestaCompra{

        protected $productos = array();

        public function nuevo_articulo($codigo){
            $producto = DB::obtieneProducto($codigo);
            if($producto !== null){
                $this->productos[] = $producto;
            }
        }

        public function get_productos(){return $this->productos;}

        public function get_coste() {
            $coste = 0;
            foreach($this->productos as $p) $coste += $p->getPVP();
            return $coste;
        }

        public function vacia(){
            return count($this->productos) === 0;
        }

        public function guarda_cesta(){$_SESSION['cesta'] = $this;}

        public static function carga_cesta(){
            if(!isset($_SESSION['cesta'])) return new CestaCompra();
            else return $_SESSION['cesta'];
        }
            
    }

?>