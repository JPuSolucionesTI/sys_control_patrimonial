<?php
require_once 'model/departamento.model.php';
require_once 'entity/departamento.entity.php';
require_once 'includes.controller.php';

class DepartamentoController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new DepartamentoModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/departamento.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $departamentos = $this->model->Listar();
        return $departamentos;
    }

    public function Consultar($idDepartamento)
    {
        $departamento = new Departamento();
        $departamento->__SET('idDepartamento',$idDepartamento);

        $consulta = $this->model->Consultar($departamento);
        return $consulta;
    }

    public function Actualizar(){
        $departamento = new Departamento();
        $departamento->__SET('idDepartamento',$_REQUEST['idDepartamento']);
        $departamento->__SET('Nombre',$_REQUEST['Nombre']);
        $departamento->__SET('Abreviatura',$_REQUEST['Abreviatura']);  
        $departamento->__SET('Estado',$_REQUEST['Estado']);       
        $actualizar = $this->model->Actualizar($departamento);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=Departamento');
            #echo 'No se Ha Podido Actualizar la Departamento';
         }else{
            #echo 'Departamento Actualizada Correctamente';
            header('Location: index.php?c=Departamento');
         }
    }

    public function Registrar(){
        $departamento = new Departamento();
        $departamento->__SET('Nombre',$_REQUEST['Nombre']);
        $departamento->__SET('Abreviatura',$_REQUEST['Abreviatura']);   
        $registrar = $this->model->Registrar($departamento);  
         
        if($registrar=='error'){
            header('Location: index.php?c=Departamento');
            //echo 'No se Ha Podido Registrar el Departamento';
         }else{
            //echo 'Departamento Registrada Correctamente';
            header('Location: index.php?c=Departamento');
         }
    }

    public function Eliminar(){
        $departamento = new Departamento();
        $departamento->__SET('idDepartamento',$_REQUEST['idDepartamento']);
        $eliminar = $this->model->Eliminar($departamento);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el Departamento';
            header('Location: index.php?c=Departamento');            
         }else{
            #echo 'Departamento Eliminado Correctamente';
            header('Location: index.php?c=Departamento');
         }
    }



}