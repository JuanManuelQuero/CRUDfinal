<?php
if(!isset($_POST['id'])) {
    header("Location:profesores.php");
    die();
}

require "../vendor/autoload.php";
use Clases\Profesores;

$profesor = new Profesores();
$profesor->setId($_POST['id']);
$profesor->delete();
$profesor = null;
$_SESSION['mensaje'] = "Profesor borrado correctamente";
header("Location:profesores.php");