<?php

class Categoria
{

    private $idCategoria;
    private $Nombre;
    private $Abreviatura;
    private $Descripcion;
    private $Tipo_Categoria;
    private $Tipo_Administracion;
    private $Fecha_Registro;
    private $Estado;    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}

