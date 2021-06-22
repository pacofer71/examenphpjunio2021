<?php
session_start();
if(!isset($_POST['id'])){
    header("Location:index.php");
    die();
}
$id=$_POST['id'];
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\Micros;
$micro=new Micros();
$micro->setId($id);
$micro->delete();
$micro=null;
$_SESSION['mensajes']="Modelo borrado.";
header("Location:index.php");
