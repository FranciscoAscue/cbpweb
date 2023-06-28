<?php 
include("../templates/datbase_web.php"); 

$sentencia = $conn_web->prepare("SELECT * FROM `ELECCIONES`;");
$sentencia->execute();
$busqueda = $sentencia->fetch(PDO::FETCH_LAZY);

include("../templates/header.php"); 
?>

<br><br><br>


<!-- ======= informacion Section ======= -->
<section id="informacion" class="informacion">
    <div class="container">

        <div class="section-title">
            <h2>ELECCIONES</h2>
            <h3><?php echo $busqueda["TITULO"] ?></h3>
            <a data-bs-toggle="collapse" data-parent="#accordion" href="#collapseOne">Ver mas</a>
            <div id="collapseOne" class="panel-collapse collapse in">
                <?php echo $busqueda["DESCRIPCION"] ?>
            </div>

        </div>
        <div class="container">
            <p>A continuación se presenta un resumen de las acciones que un biólogo debe llevar a cabo en el proceso electoral del Colegio de Biólogos del Perú:</p>
            <a data-bs-toggle="collapse" data-parent="#accordion" href="#collapselist">Ver mas</a>
            <div id="collapselist" class="panel-collapse collapse in">
                <?php echo $busqueda["ACCIONES"] ?>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col-md-6">
                    <div class="media">
                        <a href="/elecciones/eleccionesComplementarias.php">
                            <div class="media-body">
                                <h4 class="media-heading"><i class="bi bi-clipboard-check"></i>
                                Elecciones Complementarias</h4>
                            </div>
                        </a>

                        <?php echo $busqueda["E_COMPLEMENTARIAS"] ?>                    
                    </div>
                    <div class="media">
                        <a href="/elecciones/resultadosElecciones.php">
                            <div class="media-body">
                                <h4 class="media-heading"><i class="bi bi-clipboard-check"></i>
                                Resultados de Elecciones</h4>
                        </a>

                        <?php echo $busqueda["E_RESULTADOS"] ?>                    
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="media">
                    <a href="/elecciones/reglamentos&formatos.php">
                        <div class="media-body">
                            <h4 class="media-heading"><i class="bi bi-file-text"></i>
                            Reglamento y Formatos</h4>
                    </a>

                    <?php echo $busqueda["REGLAMENTO_FORMATOS"] ?>                
                </div>
            </div>
            <div class="media">
                <a href="/elecciones/jne.php">

                    <div class="media-body">
                        <h4 class="media-heading"><i class="bi bi-stack"></i>
                        Jurado Nacional de Elecciones (JNE)</h4>
                </a>

                <?php echo $busqueda["JNE"] ?>            
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>


    </div>
</section><!-- End informacion Section -->



<?php include("../templates/footer.php"); ?>