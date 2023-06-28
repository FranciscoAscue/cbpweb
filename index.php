<?php 

include("buscador/datbase.php");
include("templates/datbase_web.php");

$sentencia1 = $conn->prepare("SELECT COUNT(N_CODIGO_INTERNO) AS total_colegiados FROM TGES_COLEGIADO;");
$sentencia1 -> execute();
$resultado1 = $sentencia1->fetch(PDO::FETCH_ASSOC);
$n_colegiados = $resultado1['total_colegiados'];

$sentencia2 = $conn->prepare("SELECT COUNT(N_CODIGO_REGION) AS total_colegios FROM TGES_REGION WHERE N_CODIGO_REGION > 1000;");
$sentencia2 -> execute();
$resultado2 = $sentencia2->fetch(PDO::FETCH_ASSOC);
$n_colegios = $resultado2['total_colegios'];

$youtube = $conn_web->prepare("SELECT * FROM `VIDEO` ORDER BY `ID` DESC LIMIT 1;");
$youtube -> execute();
$youres = $youtube->fetch(PDO::FETCH_ASSOC);
$link = $youres['LINK'];

$modal = $conn_web->prepare("SELECT * FROM `MODAL` WHERE HABILITADO = 1 LIMIT 1;");
$modal -> execute();
$modalres = $modal->fetch(PDO::FETCH_LAZY);
$habilitado = $modalres['HABILITADO'];
$foto_modal = $modalres['FOTO'];

include("templates/header.php");

?>


<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container">
    <h1>COLEGIO DE BIÓLOGOS DEL PERÚ</h1>
    <h2>Consejo Directivo Nacional - Ley de creación N° 19364</h2>
    <a href="buscador/" class="btn-get-started scrollto">Buscar colegiados</a>
  </div>
</section><!-- End Hero -->

<main id="main">

<?php if (!empty($habilitado) && $habilitado == 1){ ?>
  <!-- Modal mostrar notificaciones  -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Header del Modal -->
        <div class="modal-header">
          <!-- <h5 class="modal-title">Notificaciones</h5> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <!-- Contenido del Modal -->
        <div class="modal-body">
          <img src="/assets/img/gallery/<?php echo $foto_modal ?>" loading="lazy" alt="Imagen" class="img-fluid">
        </div>

      </div>
    </div>
  </div>
<?php } ?>

  <!-- ======= Nosotros Section ======= -->
  <section id="nosotros" class="nosotros">
    <div class="container">

      <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
          <div class="content">
            <h3>COLEGIO DE BIÓLOGOS</h3>
            <p>
              Es una entidad como persona jurídica de derecho público interno, sin fines de lucro, representativa de los Biólogos profesionales en toda la República, creado por Decreto Ley N° 19364, el 18 de abril de 1972, ejerciendo la presentación oficial y defensa de la profesión, velando por el ejercicio profesional a nivel nacional con sujeción al Código de Ética ...
            </p>
            <div class="text-center">
              <a href="nosotros/" class="more-btn">Leer Mas<i class="bx bx-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
          <div class="icon-boxes d-flex flex-column justify-content-center">
            <div class="row">
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-receipt"></i>
                  <h4>Misión</h4>
                  <p>El Colegio de Biólogos del Perú es una institución gremial, con personería jurídica de derecho público interno sin fines de lucro ...</p>
                  <div class="text-center">
                    <a href="nosotros/?id=1" class="more-btn">Leer Mas</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-cube-alt"></i>
                  <h4>Visión</h4>
                  <p>El Colegio de Biólogos del Perú debe constituirse en un Colegio Profesional líder en el Perú ...</p>
                  <div class="text-center">
                    <a href="nosotros/?id=2" class="more-btn">Leer Mas</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-images"></i>
                  <h4>Información institucional</h4>
                  <p>El Colegio de Biólogos del Perú es una entidad que promueve el desarrollo profesional de biólogos...</p>
                  <div class="text-center">
                    <a href="nosotros/consejoRegional.php" class="more-btn">Leer Mas</a>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End .content-->
        </div>
      </div>

    </div>
    <br>

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bx bx-user"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $n_colegiados; ?>" data-purecounter-duration="2" class="purecounter"></span>
              <p>Colegiados</p>
            </div>
          </div>


          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bx bx-book-reader"></i>
              <span data-purecounter-start="0" data-purecounter-end="11394" data-purecounter-duration="2" class="purecounter"></span>
              <p>Especialistas</p>
            </div>
          </div>

          
          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bx bx-building-house"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $n_colegios; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Consejos regionales</p>
            </div>
          </div>

          <!-- <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-award"></i>
              <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
              <p>Distinciones</p>
            </div>
          </div> -->

        </div>

      </div>
    </section><!-- End Counts Section -->


    <div class="container" data-aos="fade-up"><br>
      <div class="row gx-0">
        <div class="col-lg-6 d-flex flex-column justify-content-center me-5" data-aos="fade-up" data-aos-delay="200">
          <div class="">
            <h3>¿Dónde puedo estudiar Biología en Perú?</h3>
            <i><b><small> El Colegio de Biólogos del Perú, te ofrecemos una selección cuidadosamente elegida de universidades y programas especializados en biología, que te brindarán una educación de calidad y te prepararán para enfrentar los retos de la profesión.</small></b></i>
            <p>
              Ya sea que desees enfocarte en ecología, biotecnología, genética o alguna otra rama de la biología, te ayudaremos a encontrar el programa de estudio que se ajuste mejor a tus necesidades. </p>
            <div class="text-center text-lg-start">
              <a href="https://blog.cbperu.org.pe/" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Leer Mas</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
          <img style="border-radius:5%" src="/assets/img/study.webp" loading="lazy" class="img-fluid" alt="">
        </div>

      </div>
    </div>
  </section><!-- End Why Us Section -->

  <!-- ======= Seccion Noticias ======= -->
  <section id="noticias" class="noticias">
    <div class="container-fluid">

      <div class="row">
        <div class="col-xl-6 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
          <a href="<?php echo $link ?>" class="glightbox play-btn mb-4"></a>
        </div>

        <div class="col-xl-6 col-lg-6 icon-boxes text-center d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
          <h3>Ultimas Noticias
            <a href="https://www.instagram.com/biologosperu/" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://twitter.com/cbiologosperu?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-screen-name="false" data-show-count="false">Follow @cbiologosperu</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          </h3>

          <div id="fb-root" class="fb-page"></div>
          <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v17.0" nonce="q1V5HRIY"></script>
          <div class="fb-page" data-href="https://www.facebook.com/ColegioDeBiologosDelPeru/" data-tabs="timeline,messages" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/ColegioDeBiologosDelPeru/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ColegioDeBiologosDelPeru/">Colegio De Biólogos Del Perú</a></blockquote>
          </div>

        </div>
      </div>

    </div>
  </section><!-- End noticias Section -->

<?php if (!empty($habilitado) && $habilitado == 1){ ?>
  <script>
    // Función para mostrar el modal automáticamente al cargar la página
    window.addEventListener('DOMContentLoaded', function() {
      var myModal = new bootstrap.Modal(document.getElementById('myModal'));
      myModal.show();
    });
  </script>
<?php } ?>

  <?php include("templates/galeria.php"); ?>
  <section class="section-bg">
    <div class="container"></div>
  </section>
  <?php include("templates/servicios.php"); ?>
  <?php include("templates/frecuentes.php"); ?>
  <?php include("templates/contact.php"); ?>
  <?php include("templates/footer.php"); ?>