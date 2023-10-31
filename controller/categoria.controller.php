<?php
require_once 'model/categoria.model.php';
require_once 'entity/categoria.entity.php';
require_once 'includes.controller.php';

class CategoriaController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new CategoriaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/categoria.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $categorias = $this->model->Listar();
        return $categorias;
    }

    public function Consultar($idCategoria)
    {
        $categoria = new Categoria();
        $categoria->__SET('idCategoria',$idCategoria);

        $consulta = $this->model->Consultar($categoria);
        return $consulta;
    }

    public function Actualizar(){
        $categoria = new Categoria();
        $categoria->__SET('idCategoria',$_REQUEST['idCategoria']);
        $categoria->__SET('Nombre',$_REQUEST['Nombre']);
        $categoria->__SET('Abreviatura',$_REQUEST['Abreviatura']);
        $categoria->__SET('Descripcion',$_REQUEST['Descripcion']); 
        $categoria->__SET('Tipo_Categoria',$_REQUEST['Tipo_Categoria']); 
        $categoria->__SET('Tipo_Administracion',$_REQUEST['Tipo_Administracion']);  
        $categoria->__SET('Estado',$_REQUEST['Estado']);
   

        $actualizar = $this->model->Actualizar($categoria);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=Categoria');
            #echo 'No se Ha Podido Actualizar la Categoria';
         }else{
            #echo 'Categoria Actualizada Correctamente';
            header('Location: index.php?c=Categoria');
         }
    }

    public function Registrar(){
        $categoria = new Categoria();
        $categoria->__SET('Nombre',$_REQUEST['Nombre']);
        $categoria->__SET('Abreviatura',$_REQUEST['Abreviatura']);
        $categoria->__SET('Descripcion',$_REQUEST['Descripcion']); 
        $categoria->__SET('Tipo_Categoria',$_REQUEST['Tipo_Categoria']); 
        $categoria->__SET('Tipo_Administracion',$_REQUEST['Tipo_Administracion']);   
        $registrar = $this->model->Registrar($categoria);  
         
        if($registrar=='error'){
            header('Location: index.php?c=Categoria');
            //echo 'No se Ha Podido Registrar el Categoria';
         }else{
            //echo 'Categoria Registrada Correctamente';
            header('Location: index.php?c=Categoria');
         }
    }

    public function Eliminar(){
        $categoria = new Categoria();
        $categoria->__SET('idCategoria',$_REQUEST['idCategoria']);
        $eliminar = $this->model->Eliminar($categoria);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el Categoria';
            header('Location: index.php?c=Categoria');            
         }else{
            #echo 'Categoria Eliminado Correctamente';
            header('Location: index.php?c=Categoria');
         }
    }



}