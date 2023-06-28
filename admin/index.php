<?php

include("datbase.php");

$COMUNICACIONES = $conn_web->prepare("SELECT COUNT(ID) AS total_comunicaciones FROM `COMUNICACIONES`;");
$COMUNICACIONES->execute();
$COMUN_res = $COMUNICACIONES->fetch(PDO::FETCH_LAZY);
$n_comunicaciones = $COMUN_res['total_comunicaciones'];


$CONSEJOS = $conn_web->prepare("SELECT COUNT(ID) AS total_consejos FROM `CONSEJO_GRUPAL`;");
$CONSEJOS->execute();
$CONSEJOS_RES = $CONSEJOS->fetch(PDO::FETCH_LAZY);
$n_consejos = $CONSEJOS_RES['total_consejos'];

$ELECCION = $conn_web->prepare("SELECT COUNT(ID) AS total_elecciones FROM `E_COMPLEMENTARIAS` WHERE ID_SECCION = 2 ;");
$ELECCION->execute();
$ELECCION_RES = $ELECCION->fetch(PDO::FETCH_LAZY);
$n_elecciones = $ELECCION_RES['total_elecciones'];


$COMUNICACIONES_s = $conn_web->prepare("SELECT TITULO, DATEDIFF(NOW(), FECHA) AS DIFERENCIA_TIEMPO FROM `COMUNICACIONES` ORDER BY FECHA DESC LIMIT 4;");
$COMUNICACIONES_s->execute();
$COMUNICACIONES_res = $COMUNICACIONES_s->fetchAll(PDO::FETCH_ASSOC);






include("templates/header.php");
?>


<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="/admin/">
        <i class="bi bi-grid"></i>
        <span>Actividades</span>
      </a>
    </li><!-- End Dashboard Nav -->


    <?php if ($_SESSION["rol"] == 0) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Configuración Principal</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo $url_base; ?>configuracion/">
              <i class="bi bi-circle"></i><span>Datos Principales</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>configuracion/usuarios.php">
              <i class="bi bi-circle"></i><span>Usuarios</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>configuracion/seo.php">
              <i class="bi bi-circle"></i><span>SEO</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
    <?php } ?>

    <?php if ($_SESSION["rol"] == 0 || $_SESSION["rol"] == 5) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Nosotros</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo $url_base; ?>nosotros/">
              <i class="bi bi-circle"></i><span>Institucional</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>nosotros/consejo_nacional.php">
              <i class="bi bi-circle"></i><span>Consejo Nacional</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>nosotros/consejo_regional.php">
              <i class="bi bi-circle"></i><span>Consejo Regional</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>nosotros/consejos_foto.php">
              <i class="bi bi-circle"></i><span>Fotos de Consejo</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
    <?php } ?>

    <?php if ($_SESSION["rol"] == 0 || $_SESSION["rol"] == 3) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#comunicaciones" data-bs-toggle="collapse" href="#">
          <i class="bi bi-newspaper"></i><span>Comunicaciones</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="comunicaciones" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo $url_base; ?>comunicaciones/">
              <i class="bi bi-circle"></i><span>Notificaciones Inicio</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>comunicaciones/ingreso.php">
              <i class="bi bi-circle"></i><span>Comunicaciones</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
    <?php } ?>

    <?php if ($_SESSION["rol"] == 0 || $_SESSION["rol"] == 1) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tramites" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-richtext"></i><span>Tramites</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tramites" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo $url_base; ?>tramites/colegiatura.php">
              <i class="bi bi-circle"></i><span>Colegiatura</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>tramites/segunda_especialidad.php">
              <i class="bi bi-circle"></i><span>Segunda Especialidad</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>tramites/otros_tramites.php">
              <i class="bi bi-circle"></i><span>Otros tramites</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
    <?php } ?>

    <?php if ($_SESSION["rol"] == 0 || $_SESSION["rol"] == 2) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#sicebiol" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-person-fill"></i><span>Sicebiol</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="sicebiol" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo $url_base; ?>sicebiol/">
              <i class="bi bi-circle"></i><span>Secciones</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
    <?php } ?>

    <?php if ($_SESSION["rol"] == 0 || $_SESSION["rol"] == 4) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#elecciones" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-check"></i><span>Elecciones</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="elecciones" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo $url_base; ?>elecciones/">
              <i class="bi bi-circle"></i><span>Datos Inicio</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>elecciones/eleccionesComplementarias.php">
              <i class="bi bi-circle"></i><span>Elecciones Complementarias</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>elecciones/ResultadoElecciones.php">
              <i class="bi bi-circle"></i><span>Resultados Elecciones</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>elecciones/ReglamentoFormatos.php">
              <i class="bi bi-circle"></i><span>Reglamentos y Formatos</span>
            </a>
          </li>
          <li>
            <a href="<?php echo $url_base; ?>elecciones/Jne.php">
              <i class="bi bi-circle"></i><span>JNE</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
    <?php } ?>


    <li class="nav-heading">Acciones</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo $url_base; ?>user/profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo $url_base; ?>logout.php">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Salir</span>
      </a>
    </li><!-- End Login Page Nav -->
  </ul>

</aside><!-- End Sidebar-->


<main id="main" class="main">

  <div class="pagetitle">
    <h1>Estadisticas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
        <li class="breadcrumb-item active">Estadisticas</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">Comunicaciones<span> | publicados</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-newspaper"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $n_comunicaciones; ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">CDN <span>| Registrados</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $n_consejos; ?></h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Elecciones <span>| En curso</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-check2-circle"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $n_elecciones; ?></h6>

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->


        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Recent Activity -->
        <div class="card">

          <div class="card-body">
            <h5 class="card-title"><span> Comunicaciones Recientes</span></h5>

            <div class="activity">
              <?php foreach ($COMUNICACIONES_res as $key) { ?>
                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo $key['DIFERENCIA_TIEMPO']; ?> días</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <?php echo $key['TITULO']; ?> <br>&emsp;
                  </div>
                </div><!-- End activity item-->

              <?php } ?>
            </div>

          </div>
        </div><!-- End Recent Activity -->
      </div><!-- End Right side columns -->

    </div>
  </section>

</main><!-- End #main -->

<?php include("templates/footer.php"); ?>