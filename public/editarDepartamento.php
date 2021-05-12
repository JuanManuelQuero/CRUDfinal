<?php
require "../vendor/autoload.php";

use Clases\Departamentos;

if (!isset($_GET['id'])) {
    header("Location:departamentos.php");
    die();
}

$id = $_GET['id'];
$esteDepartamento = new Departamentos();
$esteDepartamento->setId($id);
$datos = $esteDepartamento->read();

if (isset($_POST['editar'])) {
    $nombre = trim($_POST['nom_dep']);

    if (strlen($nombre) == 0) {
        $_SESSION['mensaje'] = "Rellene los campos";
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }

    if($datos == ucwords($nombre)) {
        $esteDepartamento = null;
        $_SESSION['mensaje'] = "Departamento actualizado correctamente";
        header("Location:departamentos.php");
        die();
    }

    if (!$esteDepartamento->existeDepartamento(strtoupper($nombre))) {
        $esteDepartamento->setNom_dep(strtoupper($nombre));

        $esteDepartamento->update();
        $esteDepartamento = null;
        $_SESSION['mensaje'] = "Departamento actualizado correctamente";
        header("Location:departamentos.php");
    } else {
        $_SESSION['mensaje'] = "El departamento ya existe";
        $esteDepartamento = null;
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <title>Editar</title>
    </head>

    <body style="background-color: lightblue;">
        <h3 class="text-center bg-dark text-light">Departamento</h3>
        <div class="container mt-3">
            <?php
            require "resources/mensaje.php";
            ?>
            <form name="na" action="<?php echo $_SERVER['PHP_SELF']."?id=$id"; ?>" method="POST">
                <div class="mt-2">
                    <label for="nombre" class="form-label">Nombre Departamento</label>
                    <input type="text" class="form-control" name="nom_dep" value="<?php echo $datos->nom_dep; ?>" required>
                </div>
                <div class="mt-2">
                    <input type="submit" class="btn btn-primary" name="editar" value="Editar">
                    <a href="departamentos.php" class="btn btn-secondary">Volver</a>
                </div>
            </form>
    </body>

    </html>
<?php } ?>