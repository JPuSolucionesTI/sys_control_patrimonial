<?php

class Cargo
{  
    private $idCargo;    
    private $Area_id;
    private $Nombre;
    private $Fecha_Registro;
    private $Estado;
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}
