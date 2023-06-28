<?php include("./datbase.php");

if (isset($_GET["ID"])) {
  $id = isset($_GET['ID']) ? $_GET['ID'] : "";

  if (empty($ID) && strlen($ID) < $minQueryLength) {
    // Ambos inputs están vacíos, no se realiza la búsqueda en la base de datos
    // Puedes mostrar un mensaje o realizar alguna acción adecuada aquí
    $mensaje = "No se ha proporcionado ningún criterio de búsqueda";
    echo $mensaje;
    // Por ejemplo: header("Location: sin_resultados.php");
    exit(); // Finalizar el script
  }

  $sentencia = $conn->prepare("SELECT * FROM `TGES_COLEGIADO` WHERE N_CODIGO_INTERNO = :id LIMIT 1;");
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $resultado1 = $sentencia->fetch(PDO::FETCH_ASSOC);
  $id_region = $resultado1['N_CODIGO_REGION'];
  $id_uni = $resultado1['N_CODIGO_UNIVERSIDAD'];


  $sentencia2 = $conn->prepare("SELECT * FROM `TGES_REGION` WHERE N_CODIGO_REGION = :idregion LIMIT 1;");
  $sentencia2->bindParam(":idregion", $id_region);
  $sentencia2->execute();
  $resultado2 = $sentencia2->fetch(PDO::FETCH_ASSOC);

  $sentencia3 = $conn->prepare("SELECT * FROM `TGES_UNIVERSIDAD` WHERE N_CODIGO_UNIVERSIDAD = :iduni LIMIT 1;");
  $sentencia3->bindParam(":iduni", $id_uni);
  $sentencia3->execute();
  $resultado3 = $sentencia3->fetch(PDO::FETCH_ASSOC);
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

  <div class="d-flex justify-content-center align-items-center">

      <a href="/buscador/" class="btn btn-warning">
        <i class="bi bi-arrow-clockwise me-1"></i>Limpiar
      </a>
    </div>

    <br>
    <div class="container d-flex justify-content-center align-items-center">
      <div class="card col-8">
        <div class="card-body d-flex justify-content-center align-items-center flex-column">
          <img src="/assets/img/logoP.webp" class="img-fluid" alt=""><br>
          <h3><?php echo $resultado1["X_NOMBRES"] . " " . $resultado1["X_APELLIDO_PATERNO"] . " " .  $resultado1["X_APELLIDO_MATERNO"]; ?></h3>
          <h5><?php echo $resultado1["X_TITULO"]; ?></h5>
          <h5><?php echo $resultado3["X_NOMBRE_UNIVERSIDAD"]; ?></h5>
          <br>
          <div class="row custom-margin">
            <div class="col-5">
              <b>N° CBP</b>
            </div>
            <div class="col-7">
              <?php echo $resultado1["N_CODIGO_INTERNO"]; ?>
            </div>
            <br><br>
            <div class="col-5">
              <b>Consejo Regional</b>
            </div>
            <div class="col-7">
              <?php echo $resultado2["X_NOMBRE_REGION"]; ?>
            </div>
            <br><br>
            <div class="col-5">
              <b>Fecha de colegiatura</b>
            </div>
            <div class="col-7">
              <?php echo date("d-m-Y", strtotime($resultado1["F_FECHA_COLEGIATURA"])); ?>
            </div>
            <br><br>
            <i>Para mayor información comunicarse a:</i>
            <br><br>

            <div class="col-5">
              <b>Dirección</b>
            </div>
            <div class="col-7">
              <?php echo $resultado2["X_DIRECCION"]; ?>
            </div>
            <br><br>

            <div class="col-5">
              <b>Teléfono</b>
            </div>
            <div class="col-7">
              <?php echo $resultado2["X_NUMERO_TELEFONO"]; ?>
            </div>
            <br><br>
            <div class="col-5">
              <b>Web</b>
            </div>
            <div class="col-7">
              <a href="https://<?php echo $resultado2["X_WEB"]; ?>">
                <?php echo $resultado2["X_WEB"]; ?></a>
            </div>
            <br><br>
            <div class="col-5">
              <b>Correo</b>
            </div>
            <div class="col-7">
              <?php echo $resultado2["X_EMAIL_CONTACT"]; ?>
            </div>
          </div>
        </div>
      </div>
    </div>


  </main><!-- End #main -->

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