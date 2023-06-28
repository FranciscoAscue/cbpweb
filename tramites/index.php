<?php
if ($_GET) {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
} else {
    $id = 1;
}
include("../templates/header.php");

$colegiatura = $conn_web->prepare("SELECT * FROM `COLEGIATURA`;");
$colegiatura->execute();
$colg_res = $colegiatura->fetchAll(PDO::FETCH_ASSOC);

$SEGUNDA_ESPECIALIDAD = $conn_web->prepare("SELECT * FROM `SEGUNDA_ESPECIALIDAD`;");
$SEGUNDA_ESPECIALIDAD->execute();
$SEGES_res = $SEGUNDA_ESPECIALIDAD->fetchAll(PDO::FETCH_ASSOC);

$TRAMITES_OTROS = $conn_web->prepare("SELECT * FROM `TRAMITES_OTROS`;");
$TRAMITES_OTROS->execute();
$TRAMOT_res = $TRAMITES_OTROS->fetchAll(PDO::FETCH_ASSOC);

?>



<br><br><br>
<!-- ======= informacion Section ======= -->

<section id="informacion" class="informacion">
    <div class="container">

        <div class="section-title">
            <h2>Tramites</h2>
        </div>

        <div class="row gy-4">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($id == 1) {
                                                echo "active show";
                                            } ?>" data-bs-toggle="tab" href="#tab-1">Colegiatura</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($id == 2) {
                                                echo "active show";
                                            } ?>" data-bs-toggle="tab" href="#tab-2">Segunda Especialidad</a>
                    </li>

                    <?php foreach ($TRAMOT_res as $sec => $value) { ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($id == $value["ID"]) {
                                                    echo "active show";
                                                } ?>" data-bs-toggle="tab" href="#<?php echo $value['TAG']?>">
                                                <?php echo $value['SECCION']?></a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <div class="col-lg-9">
                <div class="tab-content">
                    <div class="tab-pane <?php if ($id == 1) {
                                                echo "active show";
                                            } ?>" id="tab-1">
                        <div class="row gy-4">
                            <div class="col-lg-12 details order-2 order-lg-1">
                                <h3>Colegiatura</h3>
                                <div class="row gy-4">
                                    <div class="col-lg-2">
                                        <ul class="nav nav-tabs flex-column">

                                            <?php foreach ($colg_res as $sec => $value) { ?>
                                                <li class="nav-item">
                                                    <a class="nav-link <?php if ($value["ID"] == 1){
                                                        echo "active show";} ?>" data-bs-toggle="tab" 
                                                        href="#<?php echo $value["TAG"] ;?>">
                                                        <?php echo $value["SECCION"] ;?></a>
                                                </li>
                                            <?php } ?>

                                        </ul>
                                    </div>

                                    <div class="col-lg-10">
                                        <div class="tab-content">

                                        <?php foreach ($colg_res as $sec => $value) { ?>
                                            <div class="tab-pane fade <?php if ($value["ID"] == 1){ echo "active show";} ?>" 
                                                id="<?php echo $value["TAG"] ;?>" role="tabpanel" aria-labelledby="home-tab">
                                                    <?php echo $value["CONTENIDO"] ?>
                                                    <?php if(!empty($value["PDF"])){ ?>
                                                            <embed width="100%" height="700px" src="docs/<?php echo $value["PDF"]?>" />
                                                            <a href="docs/<?php echo $value["PDF"]?>" class="btn btn-primary">
                                                                <i class="bi bi-download me-1"></i>Descargar</a>
                                                   <?php } ?>
                                            </div>
                                        <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane <?php if ($id == 2) {
                                                echo "active show";
                                            } ?>" id="tab-2">
                        <div class="row gy-4">
                            <div class="col-lg-12 details order-2 order-lg-1">
                                <h3>Segunda Especialidad</h3>
                                <div class="row gy-4">
                                    <div class="col-lg-2">
                                        <ul class="nav nav-tabs flex-column">
                                        <?php foreach ($SEGES_res as $sec => $value) { ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($value["ID"] == 1){ echo "active show";} ?>" 
                                                data-bs-toggle="tab" href="#<?php echo $value["TAG"] ;?>"><?php echo $value["SECCION"] ;?></a>
                                            </li>
                                        <?php } ?>
                                        </ul>
                                    </div>

                                    <div class="col-lg-10">
                                        <div class="tab-content">
                                        <?php foreach ($SEGES_res as $sec => $value) { ?>
                                            <div class="tab-pane fade <?php if ($value["ID"] == 1){ echo "active show";} ?>" 
                                            id="<?php echo $value["TAG"] ;?>" role="tabpanel" aria-labelledby="home-tab">
                                                <?php echo $value["CONTENIDO"] ?>

                                                <?php if(!empty($value["PDF"])){ ?>
                                                            <embed width="100%" height="700px" src="docs/<?php echo $value["PDF"]?>" />
                                                            <a href="docs/<?php echo $value["PDF"]?>" class="btn btn-primary">
                                                                <i class="bi bi-download me-1"></i>Descargar</a>
                                                   <?php } ?>

                                            </div>
                                        <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($TRAMOT_res as $sec => $value) { ?>
                        <div class="tab-pane <?php if ($id == $value["ID"]) {echo "active show";} ?>" 
                            id="<?php echo $value['TAG']?>">
                            <div class="row gy-4">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <?php echo $value['CONTENIDO']?>

                                    <?php if(!empty($value["PDF"])){ ?>
                                        <embed width="100%" height="700px" src="docs/<?php echo $value["PDF"]?>" />
                                        <a href="docs/<?php echo $value["PDF"]?>" class="btn btn-primary">
                                            <i class="bi bi-download me-1"></i>Descargar</a>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section><!-- End informacion Section -->

<?php include("../templates/footer.php"); ?>

