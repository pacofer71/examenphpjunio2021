<?php
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\{Placas, Micros};

if (!isset($_GET['id'])) {
    header("Location:index.php");
    die();
}
$id = $_GET['id'];
$micro = new Micros();
$micro->setId($id);
$datos = $micro->read();
$micro = null;
$placas=new Placas();
$dplacas=$placas->getPlacasMicro($id);
$placas=null;
include dirname(__DIR__, 2) . "/layouts/plantilla1.php";
?>
<h3 class="mt-3 text-center">Micros Store</h3>
<div class="container mt-3">
    <div class="card m-auto" style="width: 48rem;">
        <div class="card-body">
            <h5 class="card-title">Marca: <?php echo $datos->marca; ?></h5>
            <h5 class="card-subtitle mb-2 text-success">Modelo: <?php echo $datos->modelo; ?></h5>
            <p class="card-text">Procesadores: <?php echo $datos->numprocesadores; ?></p>
            <p class="font-weight-bold text-center rounded shadow-lg mb-3 p-1 bg-dark text-light">Placas con esta CPU</p>
            <?php
            while($fila=$dplacas->fetch(PDO::FETCH_OBJ)){
                echo <<<TEXTO
            <a href="../placas/detalle.php?id={$fila->id}" class="card-link" style="text-decoration:none"># {$fila->modelo} ({$fila->marca})</a>
            TEXTO;
            }
            ?>
        </div>
    </div>
</div>
<div class="mt-3 text-center">
<a href="index.php" class="btn btn-success"><i class="fas fa-home"></i> Inicio</a>
</div>
</body>

</html>