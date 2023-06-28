<?php

include("../templates/datbase_web.php");

$REGLAMENTO_FORMATOS = $conn_web->prepare("SELECT * FROM `REGLAMENTO_FORMATOS_SECCION`;");
$REGLAMENTO_FORMATOS->execute();
$REGLAMENTO_FORMATOS_RES = $REGLAMENTO_FORMATOS->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["seccion"])) {
  $REG_ID = isset($_GET["seccion"]) ? $_GET['seccion'] : "";

  $REGLAMENTO_FORMATOS_SEARCH = $conn_web->prepare("SELECT * FROM `REGLAMENTO_FORMATOS` WHERE ID_SECCION = :seccion ;");
  $REGLAMENTO_FORMATOS_SEARCH->bindParam(":seccion", $REG_ID);
  $REGLAMENTO_FORMATOS_SEARCH->execute();
  $REGLAMENTO_RES = $REGLAMENTO_FORMATOS_SEARCH->fetchall(PDO::FETCH_ASSOC);
}

include("../templates/header.php"); 

?>


<br><br><br><br><br><br>


<div class="section-title">
  <h2>REGLAMENTO Y FORMATOS</h2>
</div>
<div class="container col-lg-12">
  <div class="card mx-4 border-0">
    <div class="card-body d-flex justify-content-center flex-wrap">

      <form method="get" id="search-form">
        <div class="row g-2 d-flex align-items-center">

          <div class="col-lg-10 col-md-4 custom-select">
            <select id="seccion" name="seccion" class="form-select text-center">
              <option disabled selected> Seleccionar Sección</option>
              <?php foreach ($REGLAMENTO_FORMATOS_RES as $value) { ?>
                <option <?php echo ($REG_ID == $value["ID"]) ? "selected" : ""; ?> value="<?php echo $value["ID"] ?>"><?php echo $value["SECCION"] ?></option>
              <?php } ?>
            </select>


          </div>

          <div class="col-lg-2 col-md-4 text-center custom-select">
            <button type="submit" class="btn"><i class="bi bi-search me-1"></i></button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<section id="elecciones" class="elecciones">
  <div class="container">

    <div class="row">

      <div class="col-lg-12 d-flex">
        <div class=" container icon-boxes d-flex flex-column justify-content-center">
          <div class="row justify-content-center">

            <?php foreach ($REGLAMENTO_RES as $key => $value) { ?>
              <div class="col-xl-3 box-item d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <img style="border-radius:5%" <?php if (!empty($value["FOTO"])) { ?> src="/elecciones/docs/<?php echo $value["FOTO"] ?>" <?php } else { ?> src="/assets/img/about.webp" <?php } ?> alt="Imagen" class="img-fluid">
                  <h4><?php echo $value["TITULO"] ?></h4>
                  <div class="text-center content">
                    <a href="docs/<?php echo $value["PDF"] ?>" class="more-btn"><i class="bx bxs-file-pdf"></i> </a>
                    <a class="more-btn" onclick="lectura('<?php echo $value['PDF'] ?>')"><i class="bx bxs-file-find"></i></a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div><!-- End .content-->
      </div>
    </div>

  </div>
  <br>
</section><!-- End Counts Section -->

<div class="modal" id="modal_pdf">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Header del Modal -->
      <div class="modal-header">
        <!-- <h5 class="modal-title">Notificaciones</h5> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Contenido del Modal -->
      <div class="modal-body">
        <embed width="100%" height="700px" id="pdfEmbed" />
      </div>

    </div>
  </div>
</div>

<script>
  function lectura(pdf) {
    // Establecer la ruta del PDF en el elemento embed
    var pdfEmbed = document.getElementById('pdfEmbed');
    pdfEmbed.src = "docs/" + pdf;

    // Mostrar el modal
    var modal_pdf = new bootstrap.Modal(document.getElementById('modal_pdf'));
    modal_pdf.show();
  }
</script>




<?php include("../templates/footer.php"); ?>