<?php
include_once 'conexion.php';
class CategoriaModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM categoria" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(Categoria $categoria)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM categoria WHERE idCategoria = :idCategoria");
        $stmt->bindValue(':idCategoria', $categoria->__GET('idCategoria'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new Marca();     
        $obj->__SET('idCategoria',$row->idCategoria);
        $obj->__SET('Nombre',$row->Nombre);
        $obj->__SET('Abreviatura',$row->Abreviatura);
        $obj->__SET('Descripcion',$row->Descripcion);
        $obj->__SET('Tipo_Categoria',$row->Tipo_Categoria);
        $obj->__SET('Tipo_Administracion',$row->Tipo_Administracion);
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(Categoria $categoria)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE categoria SET  Nombre=:Nombre,Abreviatura=:Abreviatura,Descripcion=:Descripcion,Tipo_Categoria=:Tipo_Categoria,Tipo_Administracion=:Tipo_Administracion,Estado=:Estado WHERE idCategoria = :idCategoria");

        $stmt->bindValue(':idCategoria',$categoria->__GET('idCategoria'));
        $stmt->bindValue(':Nombre',$categoria->__GET('Nombre'));
        $stmt->bindValue(':Abreviatura',$categoria->__GET('Abreviatura'));
        $stmt->bindValue(':Descripcion',$categoria->__GET('Descripcion'));
        $stmt->bindValue(':Tipo_Categoria',$categoria->__GET('Tipo_Categoria'));
        $stmt->bindValue(':Tipo_Administracion',$categoria->__GET('Tipo_Administracion'));
        $stmt->bindValue(':Estado',$categoria->__GET('Estado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Categoria $categoria)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO categoria(Nombre,Abreviatura,Descripcion,Tipo_Categoria,Tipo_Administracion) VALUES(:Nombre,:Abreviatura,:Descripcion,:Tipo_Categoria,:Tipo_Administracion)");
        
        $stmt->bindValue(':Nombre',$categoria->__GET('Nombre'));
        $stmt->bindValue(':Abreviatura',$categoria->__GET('Abreviatura'));
        $stmt->bindValue(':Descripcion',$categoria->__GET('Descripcion'));
        $stmt->bindValue(':Tipo_Categoria',$categoria->__GET('Tipo_Categoria'));
        $stmt->bindValue(':Tipo_Administracion',$categoria->__GET('Tipo_Administracion'));   

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Categoria $categoria)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  categoria WHERE idCategoria = :idCategoria;");

        $stmt->bindValue(':idCategoria',$categoria->__GET('idCategoria')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}