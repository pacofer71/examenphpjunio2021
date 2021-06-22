<?php
session_start();
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\Micros;

$marcas = ['Amd', 'ARM', 'Intel', 'Qualcomm', 'MediaTek'];
function error($mensaje)
{
  $_SESSION['errores'] = $mensaje;
  header("Location:{$_SERVER['PHP_SELF']}");
  die();
}
if (isset($_POST['enviar'])) {
  $marca = $_POST['marca'];
  $modelo = trim(ucwords($_POST['modelo']));
  $np = $_POST['numprocesadores'];
  if (strlen($modelo) == 0) error("Introduzca el modelo !!!");

  $micro = new Micros();
  $micro->setMarca($marca);
  $micro->setModelo($modelo);
  $micro->setNumprocesadores($np);
  $micro->create();
  $micro = null;
  $_SESSION['mensajes'] = "Procesador guardado.";
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
    <form name="f" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="mt-2">
        <label for="marcas" class="form-label">Marca</label>
        <select class="form-select" name="marca" id="marcas">
          <?php
          foreach ($marcas as $item) {
            echo <<<TEXTO
              <option>$item</option>
              TEXTO;
          }
          ?>
        </select>
      </div>
      <label for="modelo" class="form-label  mt-3">Modelo</label>
      <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-microchip"></i>
        </span>
        <input type="text" class="form-control" placeholder="Modelo" id="modelo" required name="modelo">
      </div>
      <div class="mt-2">
        <label for="nmicros" class="form-label">Número de Procesadores</label>
        <select class="form-select" name="numprocesadores" id="nmicros">
          <?php
          for ($i = 1; $i <= 8; $i++) {
            echo <<<TEXTO
              <option>$i</option>
              TEXTO;
          }
          ?>
        </select>
      </div>
      <div class="mt-3">
        <button type="submit" name="enviar" class="btn btn-info"><i class="fas fa-save"></i> Enviar</button>
        <button type="reset" class="btn btn-warning"><i class="fas fa-brush"></i> Limpiar</button>
        <a href="index.php" class="btn btn-success"><i class="fas fa-home"></i> Inicio</a>
      </div>

    </form>
  </div>
  </body>

  </html>
<?php } ?>