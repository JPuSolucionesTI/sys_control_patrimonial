<?php
require_once 'model/marca.model.php';
require_once 'entity/marca.entity.php';
require_once 'includes.controller.php';

class MarcaController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new MarcaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/marca.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $marcas = $this->model->Listar();
        return $marcas;
    }

    public function Consultar($idMarca)
    {
        $marca = new Marca();
        $marca->__SET('idMarca',$idMarca);

        $consulta = $this->model->Consultar($marca);
        return $consulta;
    }

    public function Actualizar(){
        $marca = new Marca();
        $marca->__SET('idMarca',$_REQUEST['idMarca']);
        $marca->__SET('Nombre',$_REQUEST['Nombre']);
        $marca->__SET('Descripcion',$_REQUEST['Descripcion']);  
        $marca->__SET('Estado',$_REQUEST['Estado']);       
        $actualizar = $this->model->Actualizar($marca);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=Marca');
            #echo 'No se Ha Podido Actualizar la Marca';
         }else{
            #echo 'Marca Actualizada Correctamente';
            header('Location: index.php?c=Marca');
         }
    }

    public function Registrar(){
        $marca = new Marca();
        $marca->__SET('Nombre',$_REQUEST['Nombre']);
        $marca->__SET('Descripcion',$_REQUEST['Descripcion']);   
        $registrar = $this->model->Registrar($marca);  
         
        if($registrar=='error'){
            header('Location: index.php?c=Marca');
            //echo 'No se Ha Podido Registrar el Marca';
         }else{
            //echo 'Marca Registrada Correctamente';
            header('Location: index.php?c=Marca');
         }
    }

    public function Eliminar(){
        $marca = new Marca();
        $marca->__SET('idMarca',$_REQUEST['idMarca']);
        $eliminar = $this->model->Eliminar($marca);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el Marca';
            header('Location: index.php?c=Marca');            
         }else{
            #echo 'Marca Eliminado Correctamente';
            header('Location: index.php?c=Marca');
         }
    }



}