<?php
require_once 'controller/usuario.controller.php';
$usuario = new UsuarioController();
$resultado="";

//verificar si ya se ha iniciado sesion anteriormente
if($usuario->Verificar_InicioSesion()==TRUE)
{
  
  $usuario->redirect('index.php');

}else{
  
  // verificar si se ha presionado el boton submit del formulario.
  if(isset($_POST['btn-ingresar']))
  {
    
    //almacenamos los datos enviados del formulario;
    $Correo = $_POST['Correo'];
    $Clave = $_POST['Clave'];    
    //verificar si existe el usuario y la contraseña
    if($usuario->Iniciar_Sesion($Correo,$Clave))
    {
      //si existe redireccionar al index.php
      $usuario->redirect('index.php');
    }
    else
    { 
      //si no existe mostrar el siguiente mensaje   
     $resultado = "Correo o Contraseña Incorrecta";
    } 
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Control Patrimonial </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                  <h2>Sistema de Control Patrimonial</h2>
              </div>
              <h4>Iniciar sesión para continuar.</h4>
              <form class="pt-3" action="" method="post">
                <div class="form-group">
                    <input type="hidden" name="tipo" value="iniciarSesion" />
                    <input type="text" id="Correoss" name="Correo"  class="form-control form-control-lg"  placeholder="Correo">
                </div>
                <div class="form-group">
                    <input type="password" id="Clave" name="Clave"  class="form-control form-control-lg"  placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <p class="text-red font-weight-bold">
                        <?php echo $resultado; ?>
                    </p>
                </div>
                <div class="mt-3">
                    <button type="submit" name="btn-ingresar" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Ingresar </button>
                 
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
