<?php
require_once 'model/usuario.model.php';
require_once 'entity/usuario.entity.php';
require_once 'includes.controller.php';
ini_set("session.cookie_lifetime","43200");
ini_set("session.gc_maxlifetime","43200");
session_start();
class UsuarioController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new UsuarioModel();
    }
  

     /**============================Login===========================================*/  

    public function Iniciar_Sesion($Correo,$Clave)
    {        
        //instanciamos ala entidad usuario.
        $usuario = new Usuario();
        //asignamos valores a las variables de la entidad
        $usuario->__SET('Correo',$Correo);
        $usuario->__SET('Clave',$Clave);
        //validamos al usuario en el clase modelo del usuario
        $usuario_registrado = $this->model->Validar_Usuario($usuario);
         
         //validamos que el resultado de la validacion sea diferente a FALSE
        if(!$usuario_registrado==FALSE){
            //creamos variables de session del idUsuario y el perfil
            $_SESSION['Usuario_Actual'] = $usuario_registrado['idUsuario'];
            $_SESSION['Correo']=$usuario_registrado['Correo'];
            $_SESSION['Empleado_id']=$usuario_registrado['Empleado_id'];
            //confirmamos que el usuario y la contraseña son correctas
            return TRUE;
        }else{
             //confirmamos que el usuario y la contraseña son incorrectas
             return FALSE;
        }
                               
    }

    public function Verificar_InicioSesion()
    {
        //verifico si la session a sido iniciada
        if(isset($_SESSION['Usuario_Actual']))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }



    
    public function redirect($url)
    {
        header("Location: $url");
    }    
  
    public function CerrarSesion(){
        session_destroy();
        unset($_SESSION['Usuario_Actual']);     
        header('Location: login.php');           
       
    }
    

}