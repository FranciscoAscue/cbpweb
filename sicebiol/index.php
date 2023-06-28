<?php include("../templates/header.php"); 
if ($_GET) {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
} else {
    $id = 1;
}

$SICEBIOL = $conn_web->prepare("SELECT * FROM `SICEBIOL`;");
$SICEBIOL->execute();
$SICE_RES = $SICEBIOL->fetchAll(PDO::FETCH_ASSOC);

?>
    <br><br><br>

    <!-- ======= informacion Section ======= -->
    <section id="informacion" class="informacion">
        <div class="container">

            <div class="section-title">
                <h2>SICEBIOL</h2>
                <h3>Certificación de Competencias Profesionales para Biólogos en el Perú</h3>
                <a data-bs-toggle="collapse" data-parent="#accordion" href="#collapseOne">Ver mas</a>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <p>El SICEBIOL, Sistema de Certificación de Competencias Profesionales del Biólogo en el Perú, es una iniciativa del Colegio de Biólogos del Perú que tiene como objetivo gestionar la evaluación y certificación permanente de la competencia profesional de los biólogos en el país. A través de estándares, criterios, indicadores e instrumentos de evaluación aprobados por el CBP y autorizados por el SINEACE, se busca otorgar un reconocimiento público y temporal a las habilidades adquiridas tanto dentro como fuera de las instituciones educativas, necesarias para ejercer funciones profesionales o laborales. La certificación profesional en el Perú, en su primera fase, es obligatoria para los profesionales del sector de la Salud, Educación y Derecho. SICEBIOL se compromete a cumplir con las regulaciones del SINEACE, involucrando a universidades, instituciones y empresas privadas en la capacitación continua, contando con evaluadores capacitados y honestos en los procesos de certificación y buscando una mejora continua para el desarrollo sostenido del Colegio de Biólogos del Perú. La política del SICEBIOL es revisada periódicamente por el Comité Directivo Nacional para garantizar su pertinencia y necesidad de modificaciones.</p>
                </div>

            </div>

            <div class="row gy-4">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        <?php foreach ($SICE_RES as $key => $value) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($id == $value["ID"]) { echo "active show"; } ?>" 
                                data-bs-toggle="tab" href="#<?php echo $value["TAG"] ?>"><?php echo $value["SECCION"] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content">
                    <?php foreach ($SICE_RES as $key => $value) { ?>
                        <div class="tab-pane <?php if ($id == $value["ID"]) { echo "active show"; } ?>" 
                            id="<?php echo $value["TAG"] ?>">
                            <div class="row gy-4">
                                <div class="col-lg-10 details order-2 order-lg-1">
                                    <?php echo $value["CONTENIDO"] ?>
                                    <?php if(!empty($value["PDF"])){ ?>
                                        <embed width="100%" height="700px" src="docs/<?php echo $value["PDF"]?>" />
                                        <a href="docs/<?php echo $value["PDF"]?>" class="btn btn-primary">
                                            <i class="bi bi-download me-1"></i>Descargar</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
<!-- 

                        <div class="tab-pane" id="tab-2">
                            <div class="row gy-4">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <h3>NORMATIVA</h3>
                                    <embed width="100%" height="500px" src="docs/NORMAS-DE-COMPETENCIAS-PROFESIONALES.pdf" />
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-3">
                            <div class="row gy-4">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <h3>MAPA FUNCIONAL</h3>
                                    <embed width="100%" height="500px" src="docs/MAPA-FUNCIONAL-DEL-BIOLOGO-EN-SALUD-1.pdf" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-4">
                            <div class="row gy-4">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <h3>DIRECTORIO</h3>
                                    <embed width="100%" height="500px" src="docs/RESOLUCION-Nº-066-2019-CDN-CBP.pdf" />
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-5">
                            <div class="row gy-4">
                                <div class="col-lg-12 details order-2 order-lg-2">
                                    <h3>CERTIFICACIÓN</h3>
                                    <embed width="100%" height="500px" src="docs/modelo-CONVOCATORIA-II-Semestre-2020-I-Semestre-2021-rba.pdf" />

                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>

        </div>
    </section><!-- End informacion Section -->



    <?php include("../templates/footer.php"); ?>