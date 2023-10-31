<?php
include_once 'conexion.php';
class ProveedorModel 
{
    
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM proveedor" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    
    public function Consultar(Proveedor $proveedor)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM proveedor WHERE idProveedor = :idProveedor");
        $stmt->bindValue(':idProveedor', $categoria->__GET('idProveedor'));
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $obj = new Proveedor();     
        $obj->__SET('idProveedor',$row->idProveedor);
        $obj->__SET('TipoDocumento',$row->TipoDocumento);
        $obj->__SET('Documento',$row->Documento);
        $obj->__SET('Nombre',$row->Nombre);
        $obj->__SET('Telefono',$row->Telefono);
        $obj->__SET('Correo',$row->Correo); 
        $obj->__SET('Direccion',$row->Direccion); 
        $obj->__SET('Nombre_Contacto',$row->Nombre_Contacto); 
        $obj->__SET('Telefono_Contacto',$row->Telefono_Contacto);
        $obj->__SET('Estado',$row->Estado);      

        
        return $obj;
    }

    public function Actualizar(Proveedor $proveedor)
    {    
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE proveedor SET  TipoDocumento=:TipoDocumento,Documento=:Documento,Nombre=:Nombre,Telefono=:Telefono,Correo=:Correo,Direccion=:Direccion,Nombre_Contacto=:Nombre_Contacto,Telefono_Contacto=:Telefono_Contacto,Estado=:Estado WHERE idProveedor=:idProveedor;");

        $stmt->bindValue(':idProveedor',$proveedor->__GET('idProveedor'));
        $stmt->bindValue(':TipoDocumento',$proveedor->__GET('TipoDocumento'));
        $stmt->bindValue(':Documento',$proveedor->__GET('Documento'));
        $stmt->bindValue(':Nombre',$proveedor->__GET('Nombre'));
        $stmt->bindValue(':Telefono',$proveedor->__GET('Telefono'));
        $stmt->bindValue(':Correo',$proveedor->__GET('Correo'));
        $stmt->bindValue(':Direccion',$proveedor->__GET('Direccion'));
        $stmt->bindValue(':Nombre_Contacto',$proveedor->__GET('Nombre_Contacto'));
        $stmt->bindValue(':Telefono_Contacto',$proveedor->__GET('Telefono_Contacto'));
        $stmt->bindValue(':Estado',$proveedor->__GET('Estado'));   
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Proveedor $proveedor)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO proveedor(TipoDocumento,Documento,Nombre,Telefono,Correo,Direccion,Nombre_Contacto,Telefono_Contacto) VALUES(:TipoDocumento,:Documento,:Nombre,:Telefono,:Correo,:Direccion,:Nombre_Contacto,:Telefono_Contacto)");
        
        
        $stmt->bindValue(':TipoDocumento',$proveedor->__GET('TipoDocumento'));
        $stmt->bindValue(':Documento',$proveedor->__GET('Documento'));
        $stmt->bindValue(':Nombre',$proveedor->__GET('Nombre'));
        $stmt->bindValue(':Telefono',$proveedor->__GET('Telefono'));
        $stmt->bindValue(':Correo',$proveedor->__GET('Correo'));
        $stmt->bindValue(':Direccion',$proveedor->__GET('Direccion'));
        $stmt->bindValue(':Nombre_Contacto',$proveedor->__GET('Nombre_Contacto'));
        $stmt->bindValue(':Telefono_Contacto',$proveedor->__GET('Telefono_Contacto'));   

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Proveedor $proveedor)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("DELETE FROM  proveedor WHERE idProveedor = :idProveedor;");

        $stmt->bindValue(':idProveedor',$proveedor->__GET('idProveedor')); 
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}