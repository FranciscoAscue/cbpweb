<?php
include("../datbase.php");

if (isset($_GET['ID'])) {

  $ID = (isset($_GET['ID']) ? $_GET['ID'] : "");
  $NOSOTROS = $conn_web->prepare("SELECT * FROM `NOSOTROS` WHERE `ID` = :id ;");
  $NOSOTROS->bindParam(":id", $ID);
  $NOSOTROS->execute();
  $NOSOTROS_RES = $NOSOTROS->fetch(PDO::FETCH_LAZY);

}


if(isset($_POST["seccion"])){
  
  $tag = (isset($_POST['tag'])?$_POST['tag']:"");
  $seccion = (isset($_POST['seccion'])?$_POST['seccion']:"");
  $contenido = (isset($_POST['contenido'])?$_POST['contenido']:"");

  $sentencia = $conn_web -> prepare("UPDATE `NOSOTROS` SET `TAG` = :tag ,`SECCION` = :seccion, 
  `CONTENIDO` = :contenido WHERE ID = :id;");

  $sentencia -> bindParam(":tag", $tag);
  $sentencia -> bindParam(":seccion", $seccion);
  $sentencia -> bindParam(":contenido", $contenido);
  $sentencia -> bindParam(":id", $ID);
  $sentencia -> execute();


  $pdf = (isset($_FILES['pdf']['name'])?$_FILES['pdf']['name']:"");
  $fecha = new DateTime();    
  $nombre_archivo_pdf = ($pdf !='')?$fecha->getTimestamp()."_".$_FILES['pdf']['name']:"";
  $tmp_pdf = $_FILES["pdf"]["tmp_name"];
  if($tmp_pdf!=""){
    move_uploaded_file($tmp_pdf,"../../nosotros/docs/".$nombre_archivo_pdf);
    $sentencia = $conn_web->prepare("SELECT PDF FROM `NOSOTROS` WHERE ID=:id;");
    $sentencia->bindParam(":id", $ID);
    $sentencia->execute();
    $lista_files_name = $sentencia->fetch(PDO::FETCH_LAZY);
    if(isset($lista_files_name["PDF"]) && $lista_files_name["PDF"]!=""){
      if(file_exists("../../nosotros/docs/".$lista_files_name["PDF"])){
          unlink("../../nosotros/docs/".$lista_files_name["PDF"]);
      }
    }

    $sentencia1 = $conn_web -> prepare("UPDATE `NOSOTROS` SET `PDF` = :pdf WHERE ID = :id;");
    $sentencia1 ->bindParam(":pdf", $nombre_archivo_pdf);
    $sentencia1 ->bindParam(":id", $ID);
    $sentencia1 ->execute();

  }
  $mensaje="Seccion Editada!";
  header("Location:index.php?mensaje=".$mensaje);
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

    <?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 5 ) {?>


    <li class="nav-item">
      <a class="nav-link show" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Nosotros</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?php echo $url_base; ?>nosotros/" class="active">
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
          <a href="<?php echo $url_base; ?>tramites/segunda_especiali
          dad.php">
            <i class="bi bi-circle"></i><span>Segunda Especialidad</span>
          </a>
        </li>
        <li>
          <a href="<?php echo $url_base; ?>tramites/otros_tramites.php">
            <i class="bi bi-circle"></i><span>Otros tramites</span>
          </a>
        </li>
      </ul>
    </li><!-- End Tables Nav --><?php } ?>

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
<?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 5 ) {?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Nosotros</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
        <li class="breadcrumb-item">Nosotros</li>
        <li class="breadcrumb-item active">Editar Seccion</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Editar Seccion</h5>


            <form action="" method="post" id="registro" enctype="multipart/form-data">

              <div class="row mb-3">
                <label for="inputEmail" class="col-sm-3 col-form-label">TAG</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="tag" name="tag" required 
                  placeholder="Una sola palabra ..." value="<?php echo $NOSOTROS_RES["TAG"]?>">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail" class="col-sm-3 col-form-label">SECCION</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="seccion" name="seccion" required 
                  value="<?php echo $NOSOTROS_RES["SECCION"]?>">
                </div>
              </div>
              <div class="row mb-3">
                <label for="cv" class="col-sm-3 col-form-label">
                  <a href="/nosotros/docs/<?php echo $NOSOTROS_RES["PDF"]?>" >ACTUAL PDF</a>
                </label>
                <div class="col-sm-7">
                <input type="file" class="form-control" name="pdf" id="pdf" aria-describedby="helpId" placeholder="">
                </div>
              </div>
              <br>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">CONTENDIO</label>
                <div class="col-sm-9">
                  <textarea type="" class="form-control" name="contenido" id="contenido"><?php echo $NOSOTROS_RES["CONTENIDO"]?></textarea>
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
                  <button type="submit" class="btn btn-warning">Editar Seccion</button>
                </div>
                <div class="col-sm-2">
                  <a name="" id="" class="btn btn-danger" href="/admin/nosotros/" role="button">Cancelar</a>
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