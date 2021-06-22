<?php
session_start();
if(!isset($_POST['id'])){
    header("Location:index.php");
    die();
}
$id=$_POST['id'];
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\Placas;
$placa=new Placas();
$placa->setId($id);
$placa->delete();
$placa=null;
$_SESSION['mensajes']="Placa borrada.";
header("Location:index.php");
