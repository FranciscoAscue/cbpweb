<?php

include("../datbase.php");

if (isset($_GET["ID"])) {
  $ID = (isset($_GET['ID']) ? $_GET['ID'] : "");
  $sentencia = $conn_web->prepare("SELECT * FROM `COMUNICACIONES` WHERE ID = :id LIMIT 1;");
  $sentencia->bindParam(":id", $ID);
  $sentencia->execute();
  $busqueda = $sentencia->fetch(PDO::FETCH_LAZY);
}


if (isset($_POST["id_post"])) {

  $id_post = (isset($_POST['id_post']) ? $_POST['id_post'] : "");
  $titulo = (isset($_POST['titulo']) ? $_POST['titulo'] : "");
  $tag = (isset($_POST['tag']) ? $_POST['tag'] : "");
  $fecha = (isset($_POST['fecha']) ? $_POST['fecha'] : "");
  $fecha_formateada = date('Y-m-d', strtotime($fecha));
  $contenido = (isset($_POST['contenido']) ? $_POST['contenido'] : "");

  $sentencia = $conn_web->prepare("UPDATE `COMUNICACIONES` SET `TITULO` = :titulo, `TAG` = :tag , 
  `DESCRIPCION` = :contenido , `FECHA` = :fecha WHERE ID = :id;");

  $sentencia->bindParam(":titulo", $titulo);
  $sentencia->bindParam(":tag", $tag);
  $sentencia->bindParam(":contenido", $contenido);
  $sentencia->bindParam(":fecha", $fecha_formateada);
  $sentencia->bindParam(":id", $id_post);

  $sentencia->execute();


  $foto = (isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : "");
  $fecha = new DateTime();
  $nombre_archivo_foto = ($foto != '') ? $fecha->getTimestamp() . "_" . $_FILES['foto']['name'] : "";
  $tmp_foto = $_FILES["foto"]["tmp_name"];
  if ($tmp_foto != "") {
    move_uploaded_file($tmp_foto, "../../assets/img/gallery/" . $nombre_archivo_foto);
    $sentencia = $conn_web->prepare("SELECT FOTO FROM `COMUNICACIONES` WHERE ID=:id;");
    $sentencia->bindParam(":id", $id_post);
    $sentencia->execute();
    $lista_files_name = $sentencia->fetch(PDO::FETCH_LAZY);
    if (isset($lista_files_name["FOTO"]) && $lista_files_name["FOTO"] != "") {
      if (file_exists("../../assets/img/gallery/" . $lista_files_name["FOTO"])) {
        unlink("../../assets/img/gallery/" . $lista_files_name["FOTO"]);
      }
    }

    $sentencia1 = $conn_web->prepare("UPDATE `COMUNICACIONES` SET `FOTO` = :foto WHERE ID = :id;");
    $sentencia1->bindParam(":foto", $nombre_archivo_foto);
    $sentencia1->bindParam(":id", $id_post);
    $sentencia1->execute();
  }
  $mensaje = "Datos Actualizados!";
  header("Location:ingreso.php?mensaje=" . $mensaje);
}

include("../templates/header.php");

?>



<!-- ======= Sidebar ======= -->
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
      <a class="nav-link show" data-bs-target="#comunicaciones" data-bs-toggle="collapse" href="#">
        <i class="bi bi-newspaper"></i><span>Comunicaciones</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="comunicaciones" class="nav-content" data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?php echo $url_base; ?>comunicaciones/">
            <i class="bi bi-circle"></i><span>Notificaciones Inicio</span>
          </a>
        </li>
        <li>
          <a href="<?php echo $url_base; ?>comunicaciones/ingreso.php" class="active">
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
<?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 3 ) {?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Comunicaciones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
        <li class="breadcrumb-item">Comunicaciones</li>
        <li class="breadcrumb-item active">Ingresar</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Ingresar Notificacion</h5>


            <form action="" method="post" id="registro" enctype="multipart/form-data">

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label"><b>Titulo*</b></label>

                <div class="col-sm-7">
                  <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $busqueda["TITULO"] ?>" required>
                </div>

                <div class="col-sm-2">
                  <input type="number" class="form-control" id="id_post" name="id_post" value="<?php echo $busqueda["ID"] ?>" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label"><b>Fecha*</b> / Tag</label>

                <div class="col-sm-4">
                  <input type="date" class="form-control" id="fecha" value="<?php echo $busqueda["FECHA"] ?>" name="fecha" required>
                </div>

                <div class="col-sm-5">
                  <input type="text" class="form-control" id="tag" name="tag" value="<?php echo $busqueda["TAG"] ?>">
                </div>
              </div>
              <!-- <div class="row mb-3">
                <label for="cv" class="col-sm-3 col-form-label">Archivo (PDF)</label>
                <div class="col-sm-7">
                  <input type="file" class="form-control" name="pdf" id="pdf" aria-describedby="helpId" placeholder="">
                </div>
                <div class="col-sm-2">
                  <a name="" id="" class="btn btn-info" href="https://www.ilovepdf.com/es/comprimir_pdf" role="button" target="_blank">Comprimir</a>
                </div>
              </div> -->
              <div class="row mb-3">
                <label for="cv" class="col-sm-3 col-form-label"><b>Foto (webp)*</b></label>
                <div class="col-sm-2">
                  <img width="90" src="../../assets/img/gallery/<?php echo $busqueda["FOTO"] ?>">
                </div>
                <div class="col-sm-5">
                  <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId">
                </div>
                <div class="col-sm-2">
                  <a name="" id="" class="btn btn-info" href="https://squoosh.app/" role="button" target="_blank">Squoosh</a>
                </div>
              </div>

              <br>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Descripcion</label>
                <div class="col-sm-9">
                  <textarea type="" class="form-control" name="contenido" id="contenido"></textarea>
                  <script src="../ckeditor/build/ckeditor.js"></script>
                  <script>
                    ClassicEditor
                      .create(document.querySelector('#contenido'))
                      .catch(error => {
                        console.error(error);
                      });
                  </script>
                </div>
              </div>



              <br><br>
              <div class="row mb-3 d-flex justify-content-center">
                <div class="col-sm-3">
                  <button type="submit" class="btn btn-warning">Editar Notificacion</button>
                </div>
                <div class="col-sm-2">
                  <a name="" id="" class="btn btn-danger" href="/admin/comunicaciones/ingreso.php" role="button">Cancelar</a>
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