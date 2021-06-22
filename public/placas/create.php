<?php
session_start();
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\{Placas,Micros};

$marcas = ['Asus','GigaByte','MSI'];
$micros=(new Micros())::getTodos();

function error($mensaje){
  $_SESSION['errores']=$mensaje;
  header("Location:{$_SERVER['PHP_SELF']}");
  die();
}
if (isset($_POST['enviar'])) {
  $marca=$_POST['marca'];
  $modelo=trim(ucwords($_POST['modelo']));
  $precio=$_POST['precio'];
  $mi=$_POST['microId'];
  if(strlen($modelo)==0) error("Introduzca el modelo !!!");

  $placa=new Placas();
  $placa->setMarca($marca);
  $placa->setModelo($modelo);
  $placa->setPrecio($precio);
  $placa->setMicroId($mi);
  $placa->create();
  $placa=null;
  $_SESSION['mensajes']="Placa guardada.";
  header("Location:index.php");
} else {
  include dirname(__DIR__, 2) . "/layouts/plantilla2.php";
?>
  <h3 class="mt-3 text-center">Micros Store</h3>
  <div class="container shadow-lg p-3 mb-5 bg-body rounded" style="width:50%;">
  <?php
    if(isset($_SESSION['errores'])){
      include dirname(__DIR__, 2)."/layouts/errores.php";
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
        <label for="nmicros" class="form-label">Micro</label>
        <select class="form-select" name="microId" id="nmicros">
          <?php
          while($fila=$micros->fetch(PDO::FETCH_OBJ)){
              echo "<option value='{$fila->id}'>{$fila->modelo} ({$fila->marca})</option>";
          }
          ?>
        </select>
        <label for="precio" class="form-label  mt-3">Precio</label>
      <div class="input-group">
        <span class="input-group-text" id="basic-addon1">€</span>
        <input type="number" class="form-control" placeholder="Precio" id="precio" required name="precio" step="0.01" max="10000" min='40'>
      </div>
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