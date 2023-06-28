<?php
include("../datbase.php");

$sentencia = $conn_web->prepare("SELECT * FROM `ELECCIONES`;");
$sentencia->execute();
$busqueda = $sentencia->fetch(PDO::FETCH_LAZY);

if(isset($_POST["titulo"])){
  
  $titulo = (isset($_POST['titulo'])?$_POST['titulo']:"");
  $descripcion = (isset($_POST['descripcion'])?$_POST['descripcion']:"");
  $acciones = (isset($_POST['acciones'])?$_POST['acciones']:"");

  $e_complementarias = (isset($_POST['e_complementarias'])?$_POST['e_complementarias']:"");
  $reglamento = (isset($_POST['reglamento'])?$_POST['reglamento']:"");
  $resultado = (isset($_POST['resultado'])?$_POST['resultado']:"");
  $jne = (isset($_POST['jne'])?$_POST['jne']:"");


  $sentencia = $conn_web -> prepare("UPDATE `ELECCIONES` SET `TITULO` = :titulo ,`DESCRIPCION` = :descripcion, 
  `ACCIONES` = :acciones, `E_COMPLEMENTARIAS` = :e_complementarias, `REGLAMENTO_FORMATOS` = :reglamento, 
  `E_RESULTADOS` = :resultado, `JNE` = :jne  WHERE ID = 1;");

  $sentencia -> bindParam(":titulo", $titulo);
  $sentencia -> bindParam(":descripcion", $descripcion);
  $sentencia -> bindParam(":acciones", $acciones);
  $sentencia -> bindParam(":e_complementarias", $e_complementarias);
  $sentencia -> bindParam(":reglamento", $reglamento);
  $sentencia -> bindParam(":resultado", $resultado);
  $sentencia -> bindParam(":jne", $jne);

  $sentencia -> execute();

  $mensaje="Elecciones Editada!";
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
    </li><!-- End Components Nav --><?php } ?>

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
    </li><!-- End Forms Nav --><?php } ?>

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
    </li><!-- End Tables Nav --><?php } ?>

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
    </li><!-- End Tables Nav --><?php } ?>

    <?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 4 ) {?>


    <li class="nav-item">
      <a class="nav-link show" data-bs-target="#elecciones" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person-check"></i><span>Elecciones</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="elecciones" class="nav-content" data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?php echo $url_base; ?>elecciones/" class="active">
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

<?php if($_SESSION["rol"] == 0 || $_SESSION["rol"] == 4 ) {?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Elecciones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
        <li class="breadcrumb-item">Elecciones</li>
        <li class="breadcrumb-item active"> Datos de Inicio</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Editar Inicio</h5>


            <form action="" method="post" id="registro">

              <div class="row mb-3">
                <label for="inputEmail" class="col-sm-3 col-form-label">Titulo</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="titulo" name="titulo" required value="<?php echo $busqueda["TITULO"] ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Descripcion</label>
                <div class="col-sm-9">
                  <textarea type="" class="form-control" name="descripcion" id="descripcion"><?php echo $busqueda["DESCRIPCION"] ?></textarea>
                  <script src="../ckeditor/build/ckeditor.js"></script>
                  <script>
                    ClassicEditor
                      .create(document.querySelector('#descripcion'))
                      .catch(error => {
                        console.error(error);
                      });
                  </script>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Lista de Acciones</label>
                <div class="col-sm-9">
                  <textarea type="" class="form-control" name="acciones" id="acciones"><?php echo $busqueda["ACCIONES"] ?></textarea>
                  <script src="../ckeditor/build/ckeditor.js"></script>
                  <script>
                    ClassicEditor
                      .create(document.querySelector('#acciones'))
                      .catch(error => {
                        console.error(error);
                      });
                  </script>
                </div>
              </div>           
              <br>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label"><b>Elecciones Complementarias</b></label>
                <div class="col-sm-8">
                  <textarea type="" class="form-control" name="e_complementarias" id="e_complementarias"><?php echo $busqueda["E_COMPLEMENTARIAS"] ?></textarea>
                  <script src="../ckeditor/build/ckeditor.js"></script>
                  <script>
                    ClassicEditor
                      .create(document.querySelector('#e_complementarias'))
                      .catch(error => {
                        console.error(error);
                      });
                  </script>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label"><b>Reglamento y Formatos</b></label>
                <div class="col-sm-8">
                  <textarea type="" class="form-control" name="reglamento" id="reglamento"><?php echo $busqueda["REGLAMENTO_FORMATOS"] ?></textarea>
                  <script src="../ckeditor/build/ckeditor.js"></script>
                  <script>
                    ClassicEditor
                      .create(document.querySelector('#reglamento'))
                      .catch(error => {
                        console.error(error);
                      });
                  </script>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label"><b>Resultado de Elecciones</b></label>
                <div class="col-sm-8">
                  <textarea type="" class="form-control" name="resultado" id="resultado"><?php echo $busqueda["E_RESULTADOS"] ?></textarea>
                  <script src="../ckeditor/build/ckeditor.js"></script>
                  <script>
                    ClassicEditor
                      .create(document.querySelector('#resultado'))
                      .catch(error => {
                        console.error(error);
                      });
                  </script>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label"><b>Jurado Nacional de Elecciones</b></label>
                <div class="col-sm-8">
                  <textarea type="" class="form-control" name="jne" id="jne"><?php echo $busqueda["JNE"] ?></textarea>
                  <script src="../ckeditor/build/ckeditor.js"></script>
                  <script>
                    ClassicEditor
                      .create(document.querySelector('#jne'))
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
                  <a name="" id="" class="btn btn-danger" href="/admin/elecciones/" role="button">Cancelar</a>
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