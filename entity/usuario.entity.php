<?php

class Usuario
{



    private $idUsuario;
    private $Correo;
    private $Clave;
    private $Tipo_Usuario;
    private $Empleado_id;
    private $Fecha_Registro;
    private $Estado;

    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }

   

}