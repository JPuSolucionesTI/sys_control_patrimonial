<?php
include_once 'conexion.php';
class EstacionTrabajoModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM estacion_trabajo" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(EstacionTrabajo $estaciontrabajo)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM estacion_trabajo WHERE idEstacion_Trabajo = :idEstacion_Trabajo");
        $stmt->bindValue(':idEstacion_Trabajo', $estaciontrabajo->__GET('idEstacion_Trabajo'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new EstacionTrabajo();     
        $obj->__SET('idEstacion_Trabajo',$row->idEstacion_Trabajo);
        $obj->__SET('Instalacion_id',$row->Instalacion_id);
        $obj->__SET('Nombre',$row->Nombre);  
        $obj->__SET('Descripcion',$row->Descripcion);        
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(EstacionTrabajo $estaciontrabajo)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE estacion_trabajo SET  Instalacion_id=:Instalacion_id,Nombre=:Nombre,Descripcion=:Descripcion,Estado=:Estado WHERE idEstacion_Trabajo = :idEstacion_Trabajo");

        $stmt->bindValue(':idEstacion_Trabajo',$estaciontrabajo->__GET('idEstacion_Trabajo'));
        $stmt->bindValue(':Instalacion_id',$estaciontrabajo->__GET('Instalacion_id'));
        $stmt->bindValue(':Nombre',$estaciontrabajo->__GET('Nombre'));
        $stmt->bindValue(':Descripcion',$estaciontrabajo->__GET('Descripcion'));
        $stmt->bindValue(':Estado',$estaciontrabajo->__GET('Estado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(EstacionTrabajo $estaciontrabajo)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO estacion_trabajo(Instalacion_id,Nombre,Descripcion) VALUES(:Instalacion_id,:Nombre,:Descripcion)");
        $stmt->bindValue(':Instalacion_id', $estaciontrabajo->__GET('Instalacion_id'));  
        $stmt->bindValue(':Nombre', $estaciontrabajo->__GET('Nombre'));   
        $stmt->bindValue(':Descripcion', $estaciontrabajo->__GET('Descripcion'));  

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(EstacionTrabajo $estaciontrabajo)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  estacion_trabajo WHERE idEstacion_Trabajo = :idEstacion_Trabajo;");

        $stmt->bindValue(':idEstacion_Trabajo',$estaciontrabajo->__GET('idEstacion_Trabajo')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}