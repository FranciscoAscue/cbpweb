<?php
if ($_GET) {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
} else {
    $id = 1;
}

include("../templates/header.php");


$CONSEJO = $conn_web->prepare("SELECT ID,CONSEJO FROM `CONSEJO_GRUPAL` WHERE ID > 0;");
$CONSEJO->execute();
$CONSEJO_RES = $CONSEJO->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["consejo"])){
    $consejo = isset($_GET["consejo"]) ? $_GET['consejo'] : "";

    $CONSEJO_GRUPAL = $conn_web->prepare("SELECT * FROM `CONSEJO_GRUPAL` WHERE ID = :consejo LIMIT 1;");
    $CONSEJO_GRUPAL->bindParam(":consejo", $consejo);
    $CONSEJO_GRUPAL->execute();
    $CONGRUP_RES = $CONSEJO_GRUPAL->fetch(PDO::FETCH_ASSOC);

    $CONSEJO_REGIONAL = $conn_web->prepare("SELECT * FROM `CONSEJO_REGIONAL` WHERE ID_REGION = :consejo ;");
    $CONSEJO_REGIONAL->bindParam(":consejo", $consejo);
    $CONSEJO_REGIONAL->execute();
    $CONREG_RES = $CONSEJO_REGIONAL->fetchAll(PDO::FETCH_ASSOC);
}
?>

<br><br><br>
<!-- ======= informacion Section ======= -->
<br><br>

<div class="container col-lg-4 border-0">
    <div class="card mx-4 border-0">
        <div class="card-body">
            <form method="get" id="search-form">
                <div class="row g-2 d-flex align-items-center">
                    <div class="col-lg-10 col-md-4">
                        <select id="consejo" name="consejo" class="form-select border-0 text-center placeholder-center">
                            <?php foreach ($CONSEJO_RES as $key => $value) { ?>
                                <option <?php echo ($consejo == $value["ID"]) ? "selected" : ""; ?>
                                 value="<?php echo $value["ID"] ?>"><?php echo $value["CONSEJO"]?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-4 text-center">
                        <button type="submit" class="btn"><i class="bi bi-search me-1"></i></button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

<section id="informacion" class="informacion">
    <div class="container">
        <div class="section-title">
            <?php echo $CONGRUP_RES['DESCRIPCION'] ?>
        </div>
    </div>
</section>
<!-- ======= consejo Section ======= -->
<section id="consejo" class="consejo">
    <div class="container">

        <div class="section-title">
            <h2>Consejo Directivo Regional </h2>
            <p>Gestión 2023 – 2025.</p>
        </div>

        <div class="pic text-center">
            <img style="border-radius:5%" src="/assets/img/consejo/<?php echo $CONGRUP_RES['FOTO'] ?>" class="img-fluid" alt="">
        </div>
        <br>
        <div class="row">
            <?php foreach ($CONREG_RES as $sec => $value) { ?>

                <div class="col-lg-6">
                    <div class="member d-flex align-items-start">
                        <div class="pic"><img src="/assets/img/consejo/<?php echo $value['FOTO'] ?>" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4><?php echo $value['NOMBRE'] ?></h4>
                            <span><?php echo $value['CARGO'] ?></span>
                            <!-- <p>Explicabo voluptatem </p> -->
                            <div class="social">
                                <?php if (!empty($value['twitter'])) { ?>
                                    <a href="<?php echo $value['twitter'] ?>"><i class="bx bxl-twitter"></i></a>
                                <?php } ?>

                                <?php if (!empty($value['facebook'])) { ?>
                                    <a href="<?php echo $value['facebook'] ?>"><i class="bx bxl-facebook"></i></a>
                                <?php } ?>

                                <?php if (!empty($value['instagram'])) { ?>
                                    <a href="<?php echo $value['instgram'] ?>"><i class="bx bxl-instagram"></i></a>
                                <?php } ?>

                                <?php if (!empty($value['linkedin-square'])) { ?>
                                    <a href="<?php echo $value['linkedin-square'] ?>"><i class='bx bxl-linkedin-square'></i></a>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section><!-- End consejo Section -->

<?php include("../templates/footer.php"); ?>