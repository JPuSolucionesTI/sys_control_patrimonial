<?php

class Instalacion
{


  
    private $idInstalacion;    
    private $Sede_id;
    private $Nombre;
    private $Descripcion;
    private $Fecha_Registro;
    private $Estado;
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}
