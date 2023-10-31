
<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Control Patrimonial</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/js/select.dataTables.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">

  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo RUTA_HTTP; ?>/assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo RUTA_HTTP; ?>/assets/images/favicon.png" />
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="#">
            CPDT
          </a>
          <a class="navbar-brand brand-logo-mini" href="#">
            
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Bienvenido <span class="text-black fw-bold"><?php echo $_SESSION['Correo']; ?></span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="<?php echo RUTA_HTTP; ?>/assets/images/faces/face8.jpg" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="<?php echo RUTA_HTTP; ?>/assets/images/faces/face8.jpg" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['Empleado_id']; ?></p>
                
              </div>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mi Cuenta<span class="badge badge-pill badge-danger">1</span></a>
              <a class="dropdown-item" href="${pageContext.request.contextPath}/usuario?tipo=cerrarSesion"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Cerrar Sesión</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">          
          <li class="nav-item nav-category">Modulos</li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Departamento">
              <i class="menu-icon mdi mdi-domain"></i>

              <span class="menu-title">Departamento</span>
            </a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Area">
              <i class="menu-icon mdi mdi-map-marker"></i>
              <span class="menu-title">Area</span>
            </a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Cargo">
              <i class="menu-icon mdi mdi-account-check"></i>
              <span class="menu-title">Cargo</span>
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Empleado">
              <i class="menu-icon mdi mdi-account-box-outline"></i>
              <span class="menu-title">Empleado</span>
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Sede">
              <i class="menu-icon mdi mdi-bank"></i>
              <span class="menu-title">Sede</span>
            </a>
          </li>            
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Instalacion">
              <i class="menu-icon mdi mdi-tooltip"></i>
              <span class="menu-title">Instalación</span>
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=EstacionTrabajo">
              <i class="menu-icon mdi mdi-desktop-mac"></i>
              <span class="menu-title">Estacion Trabajo</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Proveedor">
              
              <i class="menu-icon  ti-truck icon-md"></i>
              <span class="menu-title">Proveedor</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Marca">
              <i class="menu-icon mdi mdi-amazon"></i>
              <span class="menu-title">Marca</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Categoria">
              <i class="menu-icon ti-tag icon-md"></i>
              <span class="menu-title">Categoria</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Dispositivo">
              <i class="menu-icon ti-mobile icon-md"></i>
              <span class="menu-title">Dispositivos</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=ActaEntrega">
              <i class="menu-icon mdi mdi-file-pdf"></i>
              <span class="menu-title">Acta Entrega</span>
            </a>
          </li>
          <li class="nav-item nav-category">Seguridad</li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Usuario&a=CerrarSesion">
              <i class="menu-icon mdi mdi-account-key"></i>
              <span class="menu-title">Cerrar Sesión</span>
            </a>
          </li>
        </ul>
      </nav>
     <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
