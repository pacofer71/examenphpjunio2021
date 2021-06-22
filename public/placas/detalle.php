<?php
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\{Placas, Micros};

if (!isset($_GET['id'])) {
    header("Location:index.php");
    die();
}
$id = $_GET['id'];

$placa = new Placas();
$placa->setId($id);
$datosPlaca = $placa->read();
$placa = null;
$micros = new Micros();
$micros->setId($datosPlaca->microId);
$datosMicro = $micros->read();
$micros = null;
include dirname(__DIR__, 2) . "/layouts/plantilla2.php";
?>
<h3 class="mt-3 text-center">Micros Store</h3>
<div class="container mt-3">
    <div class="card m-auto" style="width: 48rem;">
        <div class="card-body">
            <h5 class="card-title">Marca: <?php echo $datosPlaca->marca; ?></h5>
            <h5 class="card-subtitle mb-2 text-success">Modelo: <?php echo $datosPlaca->modelo; ?></h5>
            <p class="card-text">Precio: <?php echo $datosPlaca->precio; ?> (€)</p>
            <p class="font-weight-bold text-center rounded shadow-lg mb-3 p-1 bg-dark text-light">Datos Cpu Placa</p>
            <?php
            if ($datosMicro!=null)
            echo
            "<a href='../micros/detalle.php?id={$datosPlaca->microId}' class='card-link' style='text-decoration:none'># {$datosMicro->modelo} ({$datosMicro->marca})</a>";
            else{
                echo "<p class='text-danger'>Sin CPU asociada!!!</p>";

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