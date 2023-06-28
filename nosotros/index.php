<?php
if ($_GET) {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
} else {
    $id = 1;
}

include("../templates/header.php");

$NOSOTROS = $conn_web->prepare("SELECT * FROM `NOSOTROS`;");
$NOSOTROS->execute();
$NOS_RES = $NOSOTROS->fetchAll(PDO::FETCH_ASSOC);

$CONSEJO_GRUPAL = $conn_web->prepare("SELECT * FROM `CONSEJO_GRUPAL` WHERE CONSEJO = 'nacional' LIMIT 1;");
$CONSEJO_GRUPAL->execute();
$CONGRUP_RES = $CONSEJO_GRUPAL->fetch(PDO::FETCH_ASSOC);

$CONSEJO_NACIONAL = $conn_web->prepare("SELECT * FROM `CONSEJO_NACIONAL`;");
$CONSEJO_NACIONAL->execute();
$CONNACIO_RES = $CONSEJO_NACIONAL->fetchAll(PDO::FETCH_ASSOC);



?>

<br><br><br>
<!-- ======= informacion Section ======= -->
<section id="informacion" class="informacion">
    <div class="container">

        <div class="section-title">
            <?php echo $CONGRUP_RES['DESCRIPCION'] ?>
        </div>

        <div class="row gy-4">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                <?php foreach ($NOS_RES as $sec => $value) { ?>

                    <li class="nav-item">
                        <a class="nav-link <?php if ($id == $value["ID"]) { echo "active show"; } ?>" 
                        data-bs-toggle="tab" href="#<?php echo $value["TAG"] ?>"><?php echo $value["SECCION"] ?></a>
                    </li>

                <?php } ?>

                </ul>
            </div>
            <div class="col-lg-9">
                <div class="tab-content">

                <?php foreach ($NOS_RES as $sec => $value) { ?>

                    <div class="tab-pane <?php if ($id == $value['ID']) { echo "active show"; } ?>" 
                    id="<?php echo $value['TAG'] ?>"> 
                        <div class="row gy-4">
                            <div class="col-lg-10 details order-2 order-lg-1">
                                <?php echo $value['CONTENIDO'] ?>
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

<!-- ======= consejo Section ======= -->
<section id="consejo" class="consejo">
    <div class="container">

        <div class="section-title">
            <h2>Consejo Directivo Nacional</h2>
            <p>Gestión 2023 – 2025.</p>
        </div>

        <div class="pic text-center">
            <img style="border-radius:5%" src="/assets/img/consejo/<?php echo $CONGRUP_RES['FOTO'] ?>" class="img-fluid" alt="">
        </div>
        <br>
        <div class="row">
        <?php foreach ($CONNACIO_RES as $sec => $value) { ?>

            <div class="col-lg-6">
                <div class="member d-flex align-items-start">
                    <div class="pic"><img src="/assets/img/consejo/<?php echo $value['FOTO'] ?>" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4><?php echo $value['NOMBRE'] ?></h4>
                        <span><?php echo $value['CARGO'] ?></span>
                        <!-- <p>Explicabo voluptatem </p> -->
                        <div class="social">
                            <?php if(!empty($value['twitter'])){ ?>
                                <a href="<?php echo $value['twitter'] ?>"><i class="bx bxl-twitter"></i></a>
                            <?php }?>

                            <?php if(!empty($value['facebook'])){ ?>
                            <a href="<?php echo $value['facebook'] ?>"><i class="bx bxl-facebook"></i></a>
                            <?php }?>

                            <?php if(!empty($value['instagram'])){ ?>
                            <a href="<?php echo $value['instgram'] ?>"><i class="bx bxl-instagram"></i></a>
                            <?php }?>

                            <?php if(!empty($value['linkedin-square'])){ ?>
                            <a href="<?php echo $value['linkedin-square'] ?>"><i class='bx bxl-linkedin-square'></i></a>
                            <?php }?>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        
        </div>

    </div>
</section><!-- End consejo Section -->

<?php include("../templates/footer.php"); ?>