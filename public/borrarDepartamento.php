<?php
if(!isset($_POST['id'])) {
    header("Location:departamentos.php");
    die();
}

require "../vendor/autoload.php";
use Clases\Departamentos;

$departamento = new Departamentos();
$departamento->setId($_POST['id']);
$departamento->delete();
$departamento = null;
$_SESSION['mensaje'] = "Departamento borrado correctamente";
header("Location:departamentos.php");