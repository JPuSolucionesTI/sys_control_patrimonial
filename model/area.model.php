<?php
include_once 'conexion.php';
class AreaModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM area" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(Area $area)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM area WHERE idArea = :idArea");
        $stmt->bindValue(':idArea', $area->__GET('idArea'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new Departamento();     
        $obj->__SET('idArea',$row->idArea);
        $obj->__SET('Departamento_id',$row->Departamento_id);
        $obj->__SET('Nombre',$row->Nombre);        
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(Area $area)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE area SET  Departamento_id=:Departamento_id,Nombre=:Nombre,Estado=:Estado WHERE idArea = :idArea");

        $stmt->bindValue(':idArea',$area->__GET('idArea'));
        $stmt->bindValue(':Departamento_id',$area->__GET('Departamento_id'));
        $stmt->bindValue(':Nombre',$area->__GET('Nombre'));
        $stmt->bindValue(':Estado',$area->__GET('Estado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Area $area)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO area(Departamento_id,Nombre) VALUES(:Departamento_id,:Nombre)");
        $stmt->bindValue(':Departamento_id', $area->__GET('Departamento_id'));  
        $stmt->bindValue(':Nombre', $area->__GET('Nombre'));  

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Area $area)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  area WHERE idArea = :idArea;");

        $stmt->bindValue(':idArea',$area->__GET('idArea')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}