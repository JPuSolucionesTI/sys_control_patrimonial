   <?php
include_once 'model/conexion.php';
require_once 'controller/usuario.controller.php'; 
require_once 'includes.controller.php';

class IndexController extends IncludesController{    
  
    private $pdo;
    public function __CONSTRUCT()
    {
        try
        {
              $this->pdo = new Conexion();                
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    
    public function Index(){

  
        require_once 'view/header.php';
        require_once 'view/index.php';
        require_once 'view/footer.php';
   

       
    }


    public function Error(){
        
  
       require_once 'view/header.php';
        #require_once 'view/404.php';
       require_once 'view/index.php';
        require_once 'view/footer.php';
      
    }

    public function Denegado(){  
        require_once 'view/header.php';
        require_once 'view/denegado.php';
        require_once 'view/footer.php';
      
    }



}