<?php
$url_base = "http://localhost:3000/admin/";

session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location:" . $url_base . "login.php");
  exit;
}

include("../datbase.php");
$modal = $conn_web->prepare("SELECT * FROM `MODAL` LIMIT 1;");
$modal -> execute();
$modalres = $modal->fetch(PDO::FETCH_LAZY);
$habilitado = $modalres['HABILITADO'];

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Administrador Web - CBP</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta content="Francisco Ascue Orosco" name="author">

  <!-- Favicons -->
  <link href="<?php echo $url_base; ?>assets/img/logo.png" rel="icon">
  <link href="<?php echo $url_base; ?>assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo $url_base; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $url_base; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo $url_base; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo $url_base; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- Agrega el estilo CSS de DataTables desde el CDN -->
  <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet">

  <!-- Agrega jQuery (asegúrate de incluirlo antes de DataTables) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Agrega el script de DataTables desde el CDN -->
  <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

  <script src="<?php echo $url_base; ?>assets/vendor/sweetalert/sweetalert2.all.min.js"></script>


  <!-- Tu código HTML y JavaScript -->

  <!-- Template Main CSS File -->
  <link href="<?php echo $url_base; ?>assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/admin/" class="logo d-flex align-items-center">
        <img src="<?php echo $url_base; ?>assets/img/LogoAperu.png" alt="">
        <span class="d-none d-lg-block">Adminstrador Web</span>
      </a><i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        
        <?php if ($habilitado == 0) { ?>

          <li class="nav-item dropdown">

            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-bell"></i>
              <span class="badge bg-primary badge-number">1</span>
            </a><!-- End Notification Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
              <li class="dropdown-header">
                Notificaciones
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4>
                    <a href="<?php echo $url_base ?>comunicaciones/">Comunicaciones Iniciales</a>
                  </h4>
                  <p>Modal desactivado</p>
                </div>
              </li>


            </ul><!-- End Notification Dropdown Items -->

          </li><!-- End Notification Nav -->
        <?php } ?>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo $url_base; ?>assets/img/female.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['usuario']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Administrador Web</h6>
              <span><?php echo $_SESSION['usuario']; ?>@cbperu.org.pe</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo $url_base; ?>user/profile.php">
                <i class="bi bi-gear"></i>
                <span>Configuracion</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="">
                <i class="bi bi-question-circle"></i>
                <span>Necesitas Ayuda?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo $url_base; ?>logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Salir</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->