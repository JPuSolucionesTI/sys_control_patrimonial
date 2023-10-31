<?php
require_once 'model/proveedor.model.php';
require_once 'entity/proveedor.entity.php';
require_once 'includes.controller.php';

class ProveedorController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new ProveedorModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/proveedor.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $proveedores = $this->model->Listar();
        return $proveedores;
    }

    public function Consultar($idProveedor)
    {
        $proveedor = new Proveedor();
        $proveedor->__SET('idProveedor',$idProveedor);

        $consulta = $this->model->Consultar($proveedor);
        return $consulta;
    }

    public function Actualizar(){
        $proveedor = new Proveedor();
        $proveedor->__SET('idProveedor',$_REQUEST['idProveedor']);
        $proveedor->__SET('TipoDocumento',$_REQUEST['TipoDocumento']);
        $proveedor->__SET('Documento',$_REQUEST['Documento']);
        $proveedor->__SET('Nombre',$_REQUEST['Nombre']);
        $proveedor->__SET('Telefono',$_REQUEST['Telefono']);
        $proveedor->__SET('Correo',$_REQUEST['Correo']); 
        $proveedor->__SET('Direccion',$_REQUEST['Direccion']); 
        $proveedor->__SET('Nombre_Contacto',$_REQUEST['Nombre_Contacto']); 
        $proveedor->__SET('Telefono_Contacto',$_REQUEST['Telefono_Contacto']);  
        $proveedor->__SET('Estado',$_REQUEST['Estado']);
   

        $actualizar = $this->model->Actualizar($proveedor);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=Proveedor');
            #echo 'No se Ha Podido Actualizar la Proveedor';
         }else{
            #echo 'Proveedor Actualizada Correctamente';
            header('Location: index.php?c=Proveedor');
         }
    }

    public function Registrar(){
        $proveedor = new Proveedor();
        $proveedor->__SET('TipoDocumento',$_REQUEST['TipoDocumento']);
        $proveedor->__SET('Documento',$_REQUEST['Documento']);
        $proveedor->__SET('Nombre',$_REQUEST['Nombre']);
        $proveedor->__SET('Telefono',$_REQUEST['Telefono']);
        $proveedor->__SET('Correo',$_REQUEST['Correo']); 
        $proveedor->__SET('Direccion',$_REQUEST['Direccion']); 
        $proveedor->__SET('Nombre_Contacto',$_REQUEST['Nombre_Contacto']); 
        $proveedor->__SET('Telefono_Contacto',$_REQUEST['Telefono_Contacto']);   
        $registrar = $this->model->Registrar($proveedor);  
         
        if($registrar=='error'){
            header('Location: index.php?c=Proveedor');
            //echo 'No se Ha Podido Registrar el Proveedor';
         }else{
            //echo 'Proveedor Registrada Correctamente';
            header('Location: index.php?c=Proveedor');
         }
    }

    public function Eliminar(){
        $proveedor = new Proveedor();
        $proveedor->__SET('idProveedor',$_REQUEST['idProveedor']);
        $eliminar = $this->model->Eliminar($proveedor);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el Proveedor';
            header('Location: index.php?c=Proveedor');            
         }else{
            #echo 'Proveedor Eliminado Correctamente';
            header('Location: index.php?c=Proveedor');
         }
    }



}