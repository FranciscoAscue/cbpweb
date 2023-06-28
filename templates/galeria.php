 <!-- ======= Gallery Section ======= -->
 <?php 
 include("datbase_web.php");

  $COMUNICACIONES = $conn_web->prepare("SELECT * FROM `COMUNICACIONES` ORDER BY FECHA DESC LIMIT 4;");
  $COMUNICACIONES->execute();
  $COMUN_res = $COMUNICACIONES->fetchAll(PDO::FETCH_ASSOC);

 ?>

 <section id="gallery" class="gallery">
    <div class="container">

      <div class="section-title">
        <h2>Comunicaciones</h2>
        <p>Conoce mas acerca del Colegio de Biólogos del Perú.</p>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row g-0 justify-content-center">

      <?php foreach ($COMUN_res as $key => $value) { ?>
        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/<?php echo $value['FOTO'] ?>" class="galelry-lightbox">
              <img src="assets/img/gallery/<?php echo $value['FOTO'] ?>" loading="lazy" class="img-fluid">
            </a>
          </div>
        </div>
      <?php } ?>

     
    </div>
  </section><!-- End Gallery Section -->