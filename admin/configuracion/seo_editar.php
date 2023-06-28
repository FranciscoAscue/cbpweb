<?php
include("../datbase.php");

if (isset($_GET["ID"])){
  $id = (isset($_GET['ID']) ? $_GET['ID'] : "");
  $sentencia = $conn_web->prepare("SELECT * FROM `SEO` WHERE ID = :id;");
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $busqueda = $sentencia->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['id_seo'])) {
  $id = (isset($_POST['id_seo']) ? $_POST['id_seo'] : "");
  $titulo_seo = (isset($_POST['titulo_seo']) ? $_POST['titulo_seo'] : "");
  $description_seo = (isset($_POST['description_seo']) ? $_POST['description_seo'] : "");
  $keywords_seo = (isset($_POST['keywords_seo']) ? $_POST['keywords_seo'] : "");

  $sentencia = $conn_web->prepare("UPDATE `SEO` SET `TITLE`= :titulo_seo  , `DESCRIPTION` = :description_seo ,
  `KEYWORDS` = :keywords_seo  WHERE `ID` = :id;");

  $sentencia->bindParam(":titulo_seo", $titulo_seo);
  $sentencia->bindParam(":description_seo", $description_seo);
  $sentencia->bindParam(":keywords_seo", $keywords_seo);
  $sentencia->bindParam(":id", $id);

  $sentencia->execute();
  $mensaje = "SEO Actualizado!";
  header("Location:seo.php?mensaje=" . $mensaje);
  exit;
}

include("../templates/header.php");
?>

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="/admin/">
        <i class="bi bi-grid"></i>
        <span>Actividades</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <?php if($_SESSION["rol"] == 0 ) {?>


    <li class="nav-item">
      <a class="nav-link show" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Configuración Principal</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content" data-bs-parent="#sidebar-nav">
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
          <a href="<?php echo $url_base; ?>configuracion/seo.php" class="active">
            <i class="bi bi-circle"></i><span>SEO</span>
          </a>
        </li>

      </ul>
    </li><!-- End Components Nav -->
    <?php } ?>

    <?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 5 ) {?>


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

    <?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 3 ) {?>


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

    <?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 1 ) {?>


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

    <?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 2 ) {?>


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

    <?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 4 ) {?>


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


<?php if($_SESSION["rol"] == 0 ) {?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Configuración</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
        <li class="breadcrumb-item">Configuración</li>
        <li class="breadcrumb-item active">Editar SEO</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Editar SEO</h5>


            <form action="" method="post" id="registro">

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">SECCION</label>

                <div class="col-sm-7">
                  <input type="text" class="form-control" id="seccion_seo" name="seccion_seo" 
                  value="<?php echo $busqueda["SECCION"]; ?>" readonly>
                </div>

                <div class="col-sm-2">
                  <input type="number" class="form-control" id="id_seo" name="id_seo" 
                  value="<?php echo $busqueda["ID"]; ?>" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">TITULO</label>

                <div class="col-sm-9">
                  <textarea type="" class="form-control" id="titulo_seo" name="titulo_seo"><?php echo $busqueda["TITLE"]; ?></textarea>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">DESCRIPCION</label>

                <div class="col-sm-9">
                  <textarea type="" class="form-control" id="description_seo" name="description_seo"><?php echo $busqueda["DESCRIPTION"]; ?></textarea>
                </div>
              </div>
             
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">KEYWORDS</label>
                <div class="col-sm-9">
                  <textarea type="" class="form-control" id="keywords_seo" name="keywords_seo"><?php echo $busqueda["KEYWORDS"]; ?></textarea>
                </div>
              </div>
             
             

              <br><br>
              <div class="row mb-3 d-flex justify-content-center">
                <div class="col-sm-3">
                  <button type="submit" class="btn btn-warning">Editar SEO</button>
                </div>
                <div class="col-sm-2">
                  <a name="" id="" class="btn btn-danger" href="/admin/configuracion/seo.php" role="button">Cancelar</a>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>
      </div>
    </div>
  </section>



</main><!-- End #main -->
<?php } ?>

<?php include("../templates/footer.php"); ?>