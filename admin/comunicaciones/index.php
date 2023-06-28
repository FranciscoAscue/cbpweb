<?php
include("../datbase.php");

$sentencia = $conn_web->prepare("SELECT * FROM `VIDEO`;");
$sentencia->execute();
$busqueda = $sentencia->fetch(PDO::FETCH_LAZY);
$video = $busqueda["LINK"];


$COMUNICACIONES = $conn_web->prepare("SELECT TITULO,FOTO FROM `COMUNICACIONES` ORDER BY FECHA DESC LIMIT 5;");
$COMUNICACIONES->execute();
$COMUN_res = $COMUNICACIONES->fetchAll(PDO::FETCH_ASSOC);

$modal = $conn_web->prepare("SELECT * FROM `MODAL` WHERE ID = 1 LIMIT 1;");
$modal -> execute();
$modalres = $modal->fetch(PDO::FETCH_LAZY);
$habilitado = $modalres['HABILITADO'];

if (isset($_POST["habilit"])) {

  $habilit = (isset($_POST['habilit']) ? $_POST['habilit'] : "");
  $foto_select = (isset($_POST['foto_select']) ? $_POST['foto_select'] : "");
  $sentencia = $conn_web->prepare("UPDATE `MODAL` SET `FOTO` = :foto_select, `HABILITADO` = :habilit WHERE ID = 1;");
  $sentencia->bindParam(":foto_select", $foto_select);
  $sentencia->bindParam(":habilit", $habilit);
  $sentencia->execute();

  $video = (isset($_POST['video']) ? $_POST['video'] : "");
  $sentencia = $conn_web->prepare("UPDATE `VIDEO` SET `LINK` = :video WHERE ID = 1;");
  $sentencia->bindParam(":video", $video);
  $sentencia->execute();

  $mensaje = "Datos Actualizados!, Asegurate de habilitar para que muestre en la pagina.";
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

    <?php if($_SESSION["rol"] == 0  ) {?>


    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Configuración Principal</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
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
          <a href="<?php echo $url_base; ?>comunicaciones/" class="active">
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

<?php if (isset($_GET["mensaje"])) { ?>
  <script>
    Swal.fire({
      icon: "info",
      title: "<?php echo $_GET["mensaje"]; ?>"
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        window.location = "index.php";
      }
    })
  </script>
<?php } ?>

<?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 3 ) {?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Configuración</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
        <li class="breadcrumb-item">Comunicaciones</li>
        <li class="breadcrumb-item active">Datos de Inicio</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Youtube Video</h5>


            <form action="" method="post" id="registro">

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Video URL</label>

                <div class="col-sm-7">
                  <input type="text" class="form-control" id="video" name="video" value="<?php echo $video; ?>">
                </div>
              </div>

              <h5 class="card-title">Notificacion Inicial</h5>

              <div class="row">
                <div class="col-sm-7">
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-5 col-form-label">Foto</label>
                    <div class="col-sm-7">
                      <select class="form-select" aria-label="Default select" id="foto_select" name="foto_select">
                        <option disabled selected> Selecciona Imagen</option>
                        <?php foreach ($COMUN_res as $value) { ?>
                          <option value="<?php echo $value["FOTO"] ?>"><?php echo $value["TITULO"] ?></option>
                        <?php } ?>

                      </select>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-5 col-form-label">Publicar</label>

                    <div class="col-sm-7">
                      <select class="form-select" aria-label="Default select" id="habilit" name="habilit">
                        <option <?php echo ($habilitado == 0) ? "selected" : ""; ?> value="0">Des-Habilitado</option>
                        <option <?php echo ($habilitado == 1) ? "selected" : ""; ?> value="1">Habilitado</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="col-sm-5">
                  <img width="120" name="imagen_seleccionada" id="imagen_seleccionada" src="">
                </div>
              </div>

              <br><br>

              <div class="row mb-3 d-flex justify-content-center">
                <div class="col-sm-3">
                  <button type="submit" class="btn btn-warning">Actualizar Datos</button>
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


<script>
  $(document).ready(function() {
    // Asignar un evento change al elemento <select> con ID "foto_select"
    $('#foto_select').change(function() {
      var foto = $(this).val(); // Obtener el valor seleccionado del elemento <select>
      var rutaFoto = "../../assets/img/gallery/" + foto; // Construir la ruta de la foto
      $('#imagen_seleccionada').attr('src', rutaFoto); // Actualizar el atributo src de la imagen
    });
  });
</script>

<?php include("../templates/footer.php"); ?>