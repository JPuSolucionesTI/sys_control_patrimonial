<?php
include_once 'conexion.php';
class CargoModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM cargo" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(Cargo $cargo)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM cargo WHERE idCargo = :idCargo");
        $stmt->bindValue(':idCargo', $cargo->__GET('idCargo'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new Cargo();     
        $obj->__SET('idCargo',$row->idArea);
        $obj->__SET('Area_id',$row->Area_id);
        $obj->__SET('Nombre',$row->Nombre);        
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(Cargo $cargo)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE cargo SET  Area_id=:Area_id,Nombre=:Nombre,Estado=:Estado WHERE idCargo = :idCargo");

        $stmt->bindValue(':idCargo',$cargo->__GET('idCargo'));
        $stmt->bindValue(':Area_id',$cargo->__GET('Area_id'));
        $stmt->bindValue(':Nombre',$cargo->__GET('Nombre'));
        $stmt->bindValue(':Estado',$cargo->__GET('Estado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Cargo $cargo)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO cargo(Area_id,Nombre) VALUES(:Area_id,:Nombre)");
        $stmt->bindValue(':Area_id', $cargo->__GET('Area_id'));  
        $stmt->bindValue(':Nombre', $cargo->__GET('Nombre'));  

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Cargo $cargo)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  cargo WHERE idCargo = :idCargo;");

        $stmt->bindValue(':idCargo',$cargo->__GET('idCargo')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}