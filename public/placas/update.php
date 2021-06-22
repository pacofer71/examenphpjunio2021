<?php
session_start();

require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\{Placas, Micros};

if (!isset($_GET['id'])) {
    header("Location:index.php");
    die();
}
$id = $_GET['id'];
$miPlaca = new Placas();
$miPlaca->setId($id);
$datosPlaca = $miPlaca->read($id);

$marcas = ['Asus', 'GigaByte', 'MSI'];
$micros = (new Micros())::getTodos();

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
    $microId = $_POST['microId'];
    $precio=$_POST['precio'];
    if (strlen($modelo) == 0) error("Introduzca el modelo !!!");


    $miPlaca->setMarca($marca);
    $miPlaca->setModelo($modelo);
    $miPlaca->setPrecio($precio);
    $miPlaca->setMicroId($microId);
    $miPlaca->update();
    $miPlaca = null;
    $_SESSION['mensajes'] = "Placa actualizada.";
    header("Location:index.php");
} else {
    include dirname(__DIR__, 2) . "/layouts/plantilla2.php";
?>
    <h3 class="mt-3 text-center">Micros Store</h3>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded" style="width:50%;">
        <?php
        if (isset($_SESSION['errores'])) {
            include dirname(__DIR__, 2) . "/layouts/errores.php";
            unset($_SESSION['errores']);
        }

        ?>
        <form name="f" action="<?php echo $_SERVER['PHP_SELF']."?id=$id"; ?>" method="POST">
            <div class="mt-2">
                <label for="marcas" class="form-label">Marca</label>
                <select class="form-select" name="marca" id="marcas">
                    <?php
                    foreach ($marcas as $item) {
                        if ($datosPlaca->marca == $item) {
                            echo "<option selected>$item</option>";
                        } else {
                            echo "<optio>$item</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label for="modelo" class="form-label  mt-3">Modelo</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-microchip"></i>
                </span>
                <input type="text" class="form-control" value="<?php echo $datosPlaca->modelo; ?>" id="modelo" required name="modelo">
            </div>
            <div class="mt-2">
                <label for="nmicros" class="form-label">Micro</label>
                <select class="form-select" name="microId" id="nmicros">
                    <?php
                    while ($fila = $micros->fetch(PDO::FETCH_OBJ)) {
                        if ($fila->id == $datosPlaca->microId) {
                            echo "<option value='{$fila->id}' selected>{$fila->modelo} ({$fila->marca})</option>";
                        } else {
                            echo "<option value='{$fila->id}'>{$fila->modelo} ({$fila->marca})</option>";
                        }
                    }
                    ?>
                </select>
                <label for="precio" class="form-label  mt-3">Precio</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">€</span>
                    <input type="number" class="form-control" value="<?php echo $datosPlaca->precio; ?>" id="precio" required name="precio" step="0.01" max="10000" min='40'>
                </div>
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