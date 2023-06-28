<?php
include("datbase_web.php");
$path = $_SERVER['REQUEST_URI'];

if ($path == "/") {

  $seccion = "principal";
  $seo = $conn_web->prepare("SELECT * FROM `SEO` WHERE SECCION = :seccion LIMIT 1;");
  $seo->bindParam(":seccion", $seccion);
  $seo->execute();
  $seo_res = $seo->fetch(PDO::FETCH_ASSOC);
}

if (preg_match("/nosotros/i", $path)) {

  if (preg_match("/consejoRegional/i", $path)) {
    $seccion = "consejoRegional";
  } else {
    $seccion = "nosotros";
  }

  $seo = $conn_web->prepare("SELECT * FROM `SEO` WHERE SECCION = :seccion LIMIT 1;");
  $seo->bindParam(":seccion", $seccion);
  $seo->execute();
  $seo_res = $seo->fetch(PDO::FETCH_ASSOC);
}

if (preg_match("/tramites/i", $path)) {

  $seccion = "tramites";
  $seo = $conn_web->prepare("SELECT * FROM `SEO` WHERE SECCION = :seccion LIMIT 1;");
  $seo->bindParam(":seccion", $seccion);
  $seo->execute();
  $seo_res = $seo->fetch(PDO::FETCH_ASSOC);
}


if (preg_match("/sicebiol/i", $path)) {

  $seccion = "sicebiol";
  $seo = $conn_web->prepare("SELECT * FROM `SEO` WHERE SECCION = :seccion LIMIT 1;");
  $seo->bindParam(":seccion", $seccion);
  $seo->execute();
  $seo_res = $seo->fetch(PDO::FETCH_ASSOC);
}

if (preg_match("/elecciones/i", $path)) {

  $seccion = "elecciones";

  if (preg_match("/eleccionesComplementarias/i", $path)) {
    $seccion = "elecciones/eleccionesComplementarias";
  } elseif (preg_match("/reglamentos/i", $path)) {
    $seccion = "elecciones/reglamentos&formatos";
  } elseif (preg_match("/resultadosElecciones/i", $path)) {
    $seccion = "elecciones/resultadosElecciones";
  } elseif (preg_match("/jne/i", $path)) {
    $seccion = "elecciones/jne";
  }

  $seo = $conn_web->prepare("SELECT * FROM `SEO` WHERE SECCION = :seccion LIMIT 1;");
  $seo->bindParam(":seccion", $seccion);
  $seo->execute();
  $seo_res = $seo->fetch(PDO::FETCH_ASSOC);
}

$TRAMITES_OTROS = $conn_web->prepare("SELECT * FROM `TRAMITES_OTROS`;");
$TRAMITES_OTROS->execute();
$TRAMOT_res = $TRAMITES_OTROS->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $seo_res["TITLE"] ?></title>
  <meta content="<?php echo $seo_res["DESCRIPTION"] ?>" name="description">
  <meta content="<?php echo $seo_res["KEYWORDS"] ?>" name="keywords">
  <meta name="author" content="<?php echo $seo_res["AUTHOR"] ?>">


  <!-- Favicons -->
  <link href="/assets/img/logo.webp" rel="icon">
  <link href="/assets/img/logo.webp" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">
  <?php
    if (preg_match("/elecciones/i", $path)) { ?>
      <link href="/elecciones/css/eleccion.css" rel="stylesheet">
  <?php } ?>

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:recepcioneinformes@cbperu.org.pe">recepcioneinformes@cbperu.org.pe</a>
        <i class="bi bi-phone"></i> <a href="tel:016955026">(01) 695 5026</a>
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="https://twitter.com/cbiologosperu?lang=es" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/ColegioDeBiologosDelPeru/" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/biologosperu/" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://www.youtube.com/channel/UCiid7INJu74Pqk5Gbch6hYQ" class="youtube"><i class="bi bi-youtube"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="/">
          <img src="/assets/img/logoP_nav.webp" alt=""> CBP</a></h1>

      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto <?php if ($seccion == "principal") {
                                            echo "active";
                                          } ?>" href="<?php if ($seccion != "principal") {
                                                        echo "/";
                                                      } ?>#hero">Inicio</a>
          </li>
          <li class="dropdown"><a class="scrollto <?php if ($seccion == "nosotros") {
                                                    echo "active";
                                                  } ?>" href="<?php if ($seccion != "principal") {
                                                                echo "/";
                                                              } ?>#nosotros">
              <span>Nosotros</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="/nosotros/#consejo">Consejo Nacional</a></li>
              <li><a href="/nosotros/consejoRegional.php?consejo=7">Consejo Regional</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="<?php if ($seccion != "principal") {
                                                    echo "/";
                                                  } ?>#noticias">Noticias</a></li>
          <li class="dropdown"><a class="scrollto <?php if ($seccion == "tramites") {
                                                    echo "active";
                                                  } ?>" href="<?php if ($seccion != "principal") {
                                                                echo "/";
                                                              } ?>#servicios">
              <span>Servicios y Trámites</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="/sicebiol/"><span>SICEBIOL</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="/sicebiol/?id=1">Objetivos</a></li>
                  <li><a href="/sicebiol/?id=2">Normativa</a></li>
                  <li><a href="/sicebiol/?id=4">Directorio</a></li>
                  <li><a href="/sicebiol/?id=5">Certificación</a></li>
                </ul>
              </li>
              <li><a href="/buscador/">Buscar Colegiados</a></li>
              <li><a href="/buscador/">Buscar Especialistas</a></li>
              <li><a href="/tramites/?id=1">Colegiatura</a></li>
              <li><a href="/tramites/?id=2">Segunda Especialidad</a></li>
              <?php foreach ($TRAMOT_res as $sec) { ?>
                <li><a href="/tramites/?id=<?php echo $sec['ID'] ?>"><?php echo $sec['SECCION'] ?></a></li>
              <?php } ?>

            </ul>
          </li>

          <li class="dropdown"><a class="scrollto <?php if (preg_match("/elecciones/i", $seccion)) {
                                                    echo "active";
                                                  } ?>" href="/elecciones"><span>Elecciones</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="/elecciones/eleccionesComplementarias.php?seccion=1">Elecciones Complementarias</a></li>
              <li><a href="/elecciones/resultadosElecciones.php?seccion=1">Resultados de Elecciones</a></li>
              <li><a href="/elecciones/reglamentos&formatos.php?seccion=1">Reglamento y Formatos</a></li>
              <li class="dropdown"><a href="/elecciones/jne.php"><span>JNE</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="/elecciones/jne.php?seccion=1">Convocatorias JNE</a></li>
                  <li><a href="/elecciones/jne.php?seccion=2">Comunicados JNE</a></li>
                  <li><a href="/elecciones/jne.php?seccion=3">Circulares JNE</a></li>
                  <li><a href="/elecciones/jne.php?seccion=4">Listas incritas JNE</a></li>
                </ul>
              </li>
            </ul>
          </li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="<?php if ($seccion != "principal") {
                  echo "/";
                } ?>#contact" class="appointment-btn scrollto">Contactese <span class="d-none d-md-inline">con Nosotros</span> </a>

    </div>
  </header><!-- End Header -->