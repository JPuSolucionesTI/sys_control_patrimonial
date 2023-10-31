<?php
include_once 'conexion.php';
class InstalacionModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM instalacion" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(Instalacion $instalacion)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM instalacion WHERE idInstalacion = :idInstalacion");
        $stmt->bindValue(':idInstalacion', $instalacion->__GET('idInstalacion'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new Instalacion();     
        $obj->__SET('idInstalacion',$row->idInstalacion);
        $obj->__SET('Sede_id',$row->Sede_id);
        $obj->__SET('Nombre',$row->Nombre);  
        $obj->__SET('Descripcion',$row->Descripcion);        
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(Instalacion $instalacion)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE instalacion SET  Sede_id=:Sede_id,Nombre=:Nombre,Descripcion=:Descripcion,Estado=:Estado WHERE idInstalacion = :idInstalacion");

        $stmt->bindValue(':idInstalacion',$instalacion->__GET('idInstalacion'));
        $stmt->bindValue(':Sede_id',$instalacion->__GET('Sede_id'));
        $stmt->bindValue(':Nombre',$instalacion->__GET('Nombre'));
        $stmt->bindValue(':Descripcion',$instalacion->__GET('Descripcion'));
        $stmt->bindValue(':Estado',$instalacion->__GET('Estado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Instalacion $instalacion)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO instalacion(Sede_id,Nombre,Descripcion) VALUES(:Sede_id,:Nombre,:Descripcion)");
        $stmt->bindValue(':Sede_id', $instalacion->__GET('Sede_id'));  
        $stmt->bindValue(':Nombre', $instalacion->__GET('Nombre'));   
        $stmt->bindValue(':Descripcion', $instalacion->__GET('Descripcion'));  

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Instalacion $instalacion)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  instalacion WHERE idInstalacion = :idInstalacion;");

        $stmt->bindValue(':idInstalacion',$instalacion->__GET('idInstalacion')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}