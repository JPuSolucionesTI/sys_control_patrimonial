<?php 
 class Conexion extends PDO { 
   private $tipo_de_base = 'mysql';
   // Conexión Servidor de producción
   private $host = 'localhost';
   private $nombre_de_base = 'control_patrimonial';
   private $usuario = 'root';
   private $contrasena = 'rootpassword';

   //Conexion Servidor de Prueba
   //private $host = '192.168.1.51';
   //private $host = '200.48.133.206';
   //private $usuario = 'root';
   //private $contrasena = 'JPuS0LUC10N3S'; 
   //private $nombre_de_base = 'bd_spartax_qa';

   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
      }catch(PDOException $e){
         // para ver el error $e->getMessage()
         //echo '<pre> Ha surgido un error y no se puede conectar a la base de datos.  Detalle: </br> Comunicarse con Soporte Tecnico</pre>';
         echo '<pre> Ha surgido un error y no se puede conectar a la base de datos.  Detalle CN1: </br>' . $e->getMessage().'</pre>';
         exit;
      }
   } 
 } 


 
 

?>
