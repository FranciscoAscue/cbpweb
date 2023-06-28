<?php
include('datbase.php');


$sentencia1 = $conn->prepare("SELECT N_CODIGO_INTERNO FROM `TGES_COLEGIADO` ORDER BY `TGES_COLEGIADO`.`N_CODIGO_INTERNO` DESC LIMIT 1;");
$sentencia1->execute();
$resultado1 = $sentencia1->fetch(PDO::FETCH_ASSOC);
$n_colegiados = $resultado1['N_CODIGO_INTERNO'];

if ($_GET) {
  $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : "";
  $apell = isset($_GET['apell']) ? $_GET['apell'] : "";
  $ncol = isset($_GET['ncol']) ? $_GET['ncol'] : "";
  $dni = isset($_GET['dni']) ? $_GET['dni'] : "";


  if (!empty($ncol) || !empty($nombre) || !empty($apell) || !empty($dni)) {
    // Se han enviado parámetros de búsqueda, realizar la lógica de búsqueda en la base de datos aquí
    $minQueryLength = 3;

    if (!empty($ncol)) {
      $ncol = $ncol;
      $conditions[] = "N_CODIGO_INTERNO = '$ncol'";
    }

    if (!empty($nombre)) {
      if (strlen($nombre) < $minQueryLength) {
        $mensaje = "Error en la busqueda : Nombre > 3 char";
        echo $mensaje;
        exit;
      } else {
        $conditions[] = "X_NOMBRES LIKE '%$nombre%'";
      }
    }

    if (!empty($apell)) {
      if (strlen($apell) < $minQueryLength) {
        $mensaje = "Error en la busqueda : Apellido > 3 char";
        echo $mensaje;
        exit;
      } else {
        $conditions[] = "X_APELLIDO_PATERNO LIKE '%$apell%'";
      }
    }

    if (!empty($dni)) {
      $dni = $dni;
      $conditions[] = "K_NUM_DE_DOCUMENTO = '$dni'";
    }
    $query = "SELECT * FROM TGES_COLEGIADO";

    // Agregar las condiciones de búsqueda si hay alguna
    if (!empty($conditions)) {
      $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Ejecutar la consulta
    $busqueda = $conn->query($query);

    // Procesar los resultados
    if ($busqueda) {
      // Obtener los resultados como un array asociativo
      $busqueda = $busqueda->fetchAll(PDO::FETCH_ASSOC);
    } else {
      $mensaje = "Error en la busqueda";
    }
  } else {
    if ($_GET) {
      $mensaje = "Debes poner al menos un campo para iniciar la busqueda";
    }
    $busqueda = null;
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Buscador de Colegiados - Colegio de Biólogos del Perú</title>
  <meta name="description" content="Busca y encuentra colegiados del Colegio de Biólogos del Perú. Encuentra biólogos especializados en diversas áreas de la biología.">
  <meta name="keywords" content="colegio de biólogos, biólogos, colegiados, Perú">
  <meta name="author" content="Francisco Ascue Orosco">

  <!-- Favicons -->
  <link href="/assets/img/logo.png" rel="icon">
  <link href="/assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <!-- Agrega el estilo CSS de DataTables desde el CDN -->
  <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet">

  <!-- Agrega jQuery (asegúrate de incluirlo antes de DataTables) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Agrega el script de DataTables desde el CDN -->
  <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Tu código HTML y JavaScript -->

  <!-- Template Main CSS File -->
  <link href="/buscador/css/main.css" rel="stylesheet">


</head>

<body>
  <main id="main-search" class="main">

    <?php if (isset($mensaje)) { ?>
      <script>
        Swal.fire({
          icon: "info",
          text: "<?php echo $mensaje; ?>"
        });
      </script>
    <?php } ?>
    <header>
      <div class="text-center my-4 animated-text">
        <h2>Buscar Colegiados</h2>
        <p>
          Ingresar algun campo para iniciar la busqueda:
        </p>
      </div>
    </header>
    <div class="d-flex justify-content-center align-items-center">
      <a href="/" class="btn btn-primary">
        <i class="bi bi-arrow-return-left me-1"></i>Regresar
      </a>
      &nbsp;
      <a href="/buscador/" class="btn btn-warning">
        <i class="bi bi-arrow-clockwise me-1"></i>Limpiar
      </a>
    </div>

    <br>
    <div class="container">
      <div class="card mx-4">
        <div class="card-body">
          <form method="get" id="search-form">
            <div class="row g-2 d-flex align-items-center">
              <div class="col-lg-3 col-md-4">
                <input type="number" id="ncol" name="ncol" min="1" max="<?php echo $n_colegiados ?>" class="form-control border-0 text-center placeholder-center" placeholder="N° Colegiatura ..." value="<?php echo $ncol ?>">
              </div>

              <div class="col-lg-3 col-md-4">
                <input type="text" id="nombre" name="nombre" class="form-control border-0 text-center placeholder-center" placeholder="Nombres ..." value="<?php echo $nombre ?>" minlength="3">
              </div>

              <div class="col-lg-3 col-md-4">
                <input type="text" id="apell" name="apell" class="form-control border-0 text-center placeholder-center" placeholder="Apellido paterno ..." value="<?php echo $apell ?>" minlength="3">
              </div>

              <div class="col-lg-2 col-md-4">
                <input type="text" id="dni" name="dni" class="form-control border-0 text-center placeholder-center" placeholder="DNI o CE ..." value="<?php echo $dni ?>">
              </div>

              <div class="col-lg-1 col-md-4 text-center">
                <button type="submit" class="btn"><i class="bi bi-search me-1"></i></button>
              </div>
            </div>


          </form>
        </div>
      </div>
    </div>
        <br>
    <div>

      <?php if (isset($busqueda)) { ?>
        <div class="card mx-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="tabla_id">
                <thead>
                  <tr>
                    <th scope="col">N° Colegiatura</th>
                    <th scope="col">Nombres y Apellidos</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Fecha de Colegiatura</th>
                    <th scope="col"><i class="bi bi-info-circle me-1"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($busqueda as $registro) { ?>
                    <tr>
                      <td scope="row"><?php echo $registro["N_CODIGO_INTERNO"]; ?></td>
                      <td scope="row">
                        <?php
                        echo $registro["X_NOMBRES"] . " " . $registro["X_APELLIDO_PATERNO"] . " " .  $registro["X_APELLIDO_MATERNO"];
                        ?>
                      </td>
                      <td scope="row"><?php echo $registro["K_NUM_DE_DOCUMENTO"]; ?></td>
                      <td scope="row"><?php echo $registro["X_TITULO"]; ?></td>
                      <td scope="row"><?php echo date("d-m-Y", strtotime($registro["F_FECHA_COLEGIATURA"])); ?></td>
                      <td>
                        <a href="/buscador/colegiados.php?ID=<?php echo $registro["N_CODIGO_INTERNO"]; ?>" class="btn btn-success">
                          <i class="bi bi-info-circle me-1"></i></a>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  <?php } ?>

  </main><!-- End #main -->

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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>

</body>

<footer>
  <br>
</footer>

</html>