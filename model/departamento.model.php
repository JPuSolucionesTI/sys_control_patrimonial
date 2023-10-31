<?php
include_once 'conexion.php';
class DepartamentoModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM departamento" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(Departamento $departamento)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM departamento WHERE idDepartamento = :idDepartamento");
        $stmt->bindValue(':idDepartamento', $departamento->__GET('idDepartamento'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new Departamento();     
        $obj->__SET('idDepartamento',$row->idDepartamento);
        $obj->__SET('Nombre',$row->Nombre);
        $obj->__SET('Abreviatura',$row->Abreviatura);
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(Departamento $departamento)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE departamento SET  Nombre=:Nombre,Abreviatura=:Abreviatura,Estado=:Estado WHERE idDepartamento = :idDepartamento");

        $stmt->bindValue(':idDepartamento',$departamento->__GET('idDepartamento'));
        $stmt->bindValue(':Nombre',$departamento->__GET('Nombre'));
        $stmt->bindValue(':Abreviatura',$departamento->__GET('Abreviatura'));
        $stmt->bindValue(':Estado',$departamento->__GET('Estado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Departamento $departamento)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO departamento(Nombre,Abreviatura) VALUES(:Nombre,:Abreviatura)");
        $stmt->bindValue(':Nombre', $departamento->__GET('Nombre'));
        $stmt->bindValue(':Abreviatura', $departamento->__GET('Abreviatura'));    

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Departamento $departamento)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  departamento WHERE idDepartamento = :idDepartamento;");

        $stmt->bindValue(':idDepartamento',$departamento->__GET('idDepartamento')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}