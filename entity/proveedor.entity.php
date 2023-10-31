<?php

class Proveedor
{
    private $idProveedor;
    private $TipoDocumento;
    private $Documento;
    private $Nombre;
    private $Telefono;
    private $Correo;
    private $Direccion;
    private $Nombre_Contacto;
    private $Telefono_Contacto;
    private $Fecha_Registro;
    private $Estado; 

    public function __GET($atributo){
      return $this->$atributo;      
    }
    
    public function __SET($atributo, $variable){
      return $this->$atributo = $variable;
    }


}

