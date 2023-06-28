<?php 
session_set_cookie_params([
  'lifetime' => 7200, // Tiempo de vida de la cookie en segundos (2 horas)
  'path' => '/admin/',
  'domain' => 'http://localhost:3000/',
  'secure' => true,
  'httponly' => true,
  'samesite' => 'Strict'
]);
session_start();

include("datbase.php");

if (isset($_POST["username"])) {
  $usuario = $_POST["username"];
  $passc = $_POST["passc"];
  $sentencia = $conn_web->prepare("SELECT * FROM `USERS` 
    WHERE `USUARIO` LIKE :usuario AND `PASSWORD` LIKE :passc;");
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":passc", $passc);
  $sentencia->execute();
  $lista_usuario = $sentencia->fetch(PDO::FETCH_LAZY);
  if ($lista_usuario["USUARIO"]) {
    $_SESSION['usuario'] = $lista_usuario['USUARIO'];
    $_SESSION['nombre'] = $lista_usuario['NOMBRE'];
    $_SESSION['rol'] = $lista_usuario['ROL'];
    $_SESSION['logueado'] = true;
    header("Location:index.php");
    exit;
  } else {
    $mensaje = "El usuario o contraseña es incorrecto";
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistema Administracion de Pagina web - Colegio Nacional de Biólogos del Perú</title>
  <meta content="Sistema de ingreso de colegiados y registro datos personales para el CBP" name="description">
  <meta content="Colegio, Biologos, sistema, CBP" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/LogoAperu.png" alt="">
                  <span class="d-none d-lg-block">Administrador Web</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Ingresa a tu cuenta</h5>
                    <p class="text-center small">Ingrese su correo y contraseña</p>
                  </div>
                  <?php if (isset($mensaje)) { ?>
                    <div class="alert alert-danger" role="alert">
                      <strong><?php echo $mensaje; ?></strong>
                    </div>
                  <?php } ?>

                  <form method="post" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="username" required>
                        <span class="input-group-text" id="inputGroupPrepend">@cbperu.org.pe</span>
                        <div class="invalid-feedback">Ingrese email!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Contraseña</label>
                      <input type="password" id="passc" name="passc" class="form-control" required>
                      <div class="invalid-feedback">Ingrese contraseña!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Recordarme</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Ingresar</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">No tiene cuenta? <a href="#">Comuniquese con Soporte.</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Soporte a <a href="#">Francisco Ascue</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>