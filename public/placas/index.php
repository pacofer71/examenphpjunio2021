<?php
session_start();
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\Placas;

$todos = (new Placas())::getTodos();
include dirname(__DIR__, 2) . "/layouts/plantilla2.php";
?>
<h3 class="mt-3 text-center">Micros Store</h3>
<div class="container mt-2">
<?php
    if(isset($_SESSION['mensajes'])){
      include dirname(__DIR__, 2)."/layouts/mensajes.php";
      unset($_SESSION['mensajes']);
    }
    
  ?>
    <a href="create.php" class="btn btn-success my-2"><i class="fas fa-plus"></i> Nuevo</a>
    <table class="table table-dark table-striped" id="tabmicros">
        <thead>
            <tr>
                <th scope="col">Detalle</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Precio (€)</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($fila=$todos->fetch(PDO::FETCH_OBJ)){
                echo <<<CADENA
                <tr>
                <th scope="row">
                    <a href="detalle.php?id={$fila->id}" class="btn btn-primary"><i class="fas fa-info"></i> Detalle</a>
                </th>
                <td>{$fila->marca}</td>
                <td>{$fila->modelo}</td>
                <td>{$fila->precio}</td>
                <td>
                <form class="form form-inline" method="POST" action="borrar.php">
                <input type="hidden" value="{$fila->id}" name="id">
                <a href="update.php?id={$fila->id}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button> 
                </form>
                </td>
                </tr>
            CADENA;
            }
            ?>

        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" ></script>
<script>
    $(document).ready(function() {
        $('#tabmicros').DataTable();
    });
</script>
</body>

</html>