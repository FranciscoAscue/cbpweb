<?php
include("../datbase.php");


$sentencia = $conn_web->prepare("SELECT *,(SELECT SECCION FROM `E_RESULTADOS_SECCION` 
WHERE `E_RESULTADOS_SECCION`.`ID` = `E_RESULTADOS`.`ID_SECCION` LIMIT 1) AS SECCION FROM `E_RESULTADOS`;");

$sentencia->execute();
$busqueda = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['ID'])) {

  $ID = (isset($_GET['ID']) ? $_GET['ID'] : "");
  $sentencia1 = $conn_web->prepare("DELETE FROM `E_RESULTADOS` WHERE ID = :id;");
  $sentencia1->bindParam(":id", $ID);
  $sentencia1->execute();
  $mensaje = "Documento eliminado!";
  header("Location:ResultadoElecciones.php?mensaje=" . $mensaje);
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
          <a href="<?php echo $url_base; ?>elecciones/ResultadoElecciones.php" class="active">
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
                window.location = "ResultadoElecciones.php";
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
        <li class="breadcrumb-item active">Resultados Elecciones</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Reglamento y Formatos  &emsp;
            <a href="ResultadoElecciones_agregar.php" class="btn btn-primary">+ Agregar Documento</a>
            <a href="ResultadoElecciones_seccion.php" class="btn btn-warning">+ Crear/Editar Seccion</a>
            </h5>
            <!-- Table with stripped rows -->

            <div class="table-responsive">
              <table class="table table-striped" id="tabla_id">
                <thead>
                  <tr>
                    <th scope="col">N°_ID</th>
                    <th scope="col">SECCION</th>
                    <th scope="col">TITULO</th>
                    <th scope="col">FOTO</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ACCIONES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($busqueda as $registro) { ?>
                    <tr>
                      <td scope="row"><?php echo $registro["ID"]; ?></td>
                      <td scope="row"><small><b>
                        <?php echo $registro["SECCION"]; ?>
                        </b></small></td>
                      <td scope="row"><?php echo $registro["TITULO"]; ?></td>
                      <td scope="row">
                        <img width="50" src="../../elecciones/docs/<?php echo $registro["FOTO"]; ?>">
                      </td>
                      <td scope="row"><?php echo $registro["FECHA"]; ?></td>
                      <td scope="row">
                      <a name="" id="" class="btn btn-warning" 
                        href="ResultadoElecciones_editar.php?ID=<?php echo $registro['ID']; ?>" 
                        role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="bi bi-pencil me-1"></i></a>
 
                        <a name="" id="" class="btn btn-danger" 
                        href="javascript:borrar(<?php 
                        echo $registro['ID']; ?>)" 
                        role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar"><i class="bi bi-trash me-1"></i></a>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>



</main><!-- End #main -->
<?php } ?>

<script>
    function borrar(id) {

        Swal.fire({
            title: 'Desea borrar el Documento?',
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Si',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location = "ResultadoElecciones.php?ID=" + encodeURI(id);
            }
        })
    }
</script>

<script>
  $(document).ready(function() {
    $('#tabla_id').DataTable({
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
      },
      "paging": true, // Activar paginación
      "searching": true, // Activar búsqueda
      "lengthMenu": [10, 25, 50, 75, 100], // Opciones de cantidad de registros por página
      "pageLength": 10, // Cantidad de registros por página por defecto
      "order": [
        [0, 'asc']
      ], // Ordenar por la primera columna en orden ascendente
    });
  });
</script>

<?php include("../templates/footer.php"); ?>
