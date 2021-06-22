<?php
session_start();

require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\Micros;

if (!isset($_GET['id'])) {
    header("Location:index.php");
    die();
}

$id = $_GET['id'];
$micro=new Micros();
$micro->setId($id);
$datos=$micro->read();

$marcas = ['Amd', 'ARM', 'Intel', 'Qualcomm', 'MediaTek'];
function error($mensaje)
{
    global $id;
    $_SESSION['errores'] = $mensaje;
    header("Location:{$_SERVER['PHP_SELF']}?id=$id");
    die();
}
if (isset($_POST['update'])) {
    $marca = $_POST['marca'];
    $modelo = trim(ucwords($_POST['modelo']));
    $np = $_POST['numprocesadores'];
    if (strlen($modelo) == 0) error("Introduzca el modelo !!!");

   
    $micro->setMarca($marca);
    $micro->setModelo($modelo);
    $micro->setNumprocesadores($np);
    $micro->update();
    $micro = null;
    $_SESSION['mensajes'] = "Procesador actualizado.";
    header("Location:index.php");
} else {
    include dirname(__DIR__, 2) . "/layouts/plantilla1.php";
?>
    <h3 class="mt-3 text-center">Micros Store</h3>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded" style="width:50%;">
        <?php
        if (isset($_SESSION['errores'])) {
            include dirname(__DIR__, 2) . "/layouts/errores.php";
            unset($_SESSION['errores']);
        }

        ?>
        <form name="f" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method="POST">
            <div class="mt-2">
                <label for="marcas" class="form-label">Marca</label>
                <select class="form-select" name="marca" id="marcas">
                    <?php
                    foreach ($marcas as $item) {
                       if($item==$datos->marca){
                           echo "<option selected>$item</option>";
                       }
                       else{
                        echo "<option>$item</option>"; 
                       }
                    }
                    ?>
                </select>
            </div>
            <label for="modelo" class="form-label  mt-3">Modelo</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-microchip"></i>
                </span>
                <input type="text" class="form-control" value="<?php echo $datos->modelo; ?>" id="modelo" required name="modelo">
            </div>
            <div class="mt-2">
                <label for="nmicros" class="form-label">Número de Procesadores</label>
                <select class="form-select" name="numprocesadores" id="nmicros">
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                     if($i==$datos->numprocesadores){
                        echo "<option selected>$i</option>";
                     }
                     else{
                        echo "<option>$i</option>";
                     }
                    }
                    ?>
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" name="update" class="btn btn-info"><i class="fas fa-edit"></i> Editar</button>
                <button type="reset" class="btn btn-warning"><i class="fas fa-brush"></i> Limpiar</button>
                <a href="index.php" class="btn btn-success"><i class="fas fa-home"></i> Inicio</a>
            </div>

        </form>
    </div>
    </body>

    </html>
<?php } ?>