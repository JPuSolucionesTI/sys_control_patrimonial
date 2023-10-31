<?php
include_once 'conexion.php';
class MarcaModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM marca" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(Marca $marca)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM marca WHERE idMarca = :idMarca");
        $stmt->bindValue(':idMarca', $marca->__GET('idMarca'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new Marca();     
        $obj->__SET('idMarca',$row->idMarca);
        $obj->__SET('Nombre',$row->Nombre);
        $obj->__SET('Descripcion',$row->Descripcion);
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(Marca $marca)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE marca SET  Nombre=:Nombre,Descripcion=:Descripcion,Estado=:Estado WHERE idMarca = :idMarca");

        $stmt->bindValue(':idMarca',$marca->__GET('idMarca'));
        $stmt->bindValue(':Nombre',$marca->__GET('Nombre'));
        $stmt->bindValue(':Descripcion',$marca->__GET('Descripcion'));
        $stmt->bindValue(':Estado',$marca->__GET('Estado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Marca $marca)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO marca(Nombre,Descripcion) VALUES(:Nombre,:Descripcion)");
        $stmt->bindValue(':Nombre', $marca->__GET('Nombre'));
        $stmt->bindValue(':Descripcion', $marca->__GET('Descripcion'));    

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Marca $marca)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  marca WHERE idMarca = :idMarca;");

        $stmt->bindValue(':idMarca',$marca->__GET('idMarca')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}