<?php
include_once 'conexion.php';
class SedeModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM sede" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(Sede $sede)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM sede WHERE idSede = :idSede");
        $stmt->bindValue(':idSede', $sede->__GET('idSede'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new Sede();     
        $obj->__SET('idSede',$row->idSede);
        $obj->__SET('Nombre',$row->Nombre);
        $obj->__SET('Direccion',$row->Direccion);
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(Sede $sede)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE sede SET  Nombre=:Nombre,Direccion=:Direccion,Estado=:Estado WHERE idSede = :idSede");

        $stmt->bindValue(':idSede',$sede->__GET('idSede'));
        $stmt->bindValue(':Nombre',$sede->__GET('Nombre'));
        $stmt->bindValue(':Direccion',$sede->__GET('Direccion'));
        $stmt->bindValue(':Estado',$sede->__GET('Estado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Sede $sede)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO sede(Nombre,Direccion) VALUES(:Nombre,:Direccion)");
        $stmt->bindValue(':Nombre', $sede->__GET('Nombre'));
        $stmt->bindValue(':Direccion', $sede->__GET('Direccion'));    

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Sede $sede)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  sede WHERE idSede = :idSede;");

        $stmt->bindValue(':idSede',$sede->__GET('idSede')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}