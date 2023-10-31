<?php

class Departamento
{


  
    private $idDepartamento;
    private $Nombre;
    private $Abreviatura;
    private $Fecha_Registro;
    private $Estado;
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}
