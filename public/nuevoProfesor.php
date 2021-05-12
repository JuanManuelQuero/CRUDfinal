<?php
require "../vendor/autoload.php";

use Clases\Profesores;
use Clases\Departamentos;

if (isset($_POST['crear'])) {
    $nombre = trim($_POST['nom_prof']);
    $sueldo = trim($_POST['sueldo']);
    $fecha = trim($_POST['fecha_prof']);
    $departamento = trim($_POST['nom_dep']);

    if (strlen($nombre) == 0 || strlen($sueldo) == 0 || strlen($fecha) == 0 || strlen($departamento) == 0) {
        $_SESSION['mensaje'] = "Rellene los campos";
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }

    $esteProfesor = new Profesores();
    if (!$esteProfesor->existeProfesor(ucwords($nombre))) {
        $esteProfesor->setNom_prof(ucwords($nombre));
        $esteProfesor->setSueldo($sueldo);
        $esteProfesor->setFecha_prof($fecha);

        $esteProfesor->create();

        $esteDepartamento = new Departamentos();
        $esteDepartamento->setNom_dep($departamento);
        foreach($_POST['nom_dep'] as $k=>$v) {
            $esteDepartamento->setId($v);
            $esteDepartamento->create();
        }
        $esteProfesor = null;
        $esteDepartamento = null;
        $_SESSION['mensaje'] = "Profesor añadido correctamente";
        header("Location:profesores.php");
    } else {
        $_SESSION['mensaje'] = "El profesor ya existe";
        $esteProfesor = null;
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
        <title>Añadir</title>
    </head>

    <body style="background-color: lightblue;">
        <h3 class="text-center bg-dark text-light">Nuevo Profesor</h3>
        <div class="container mt-3">
            <?php
            require "resources/mensaje.php";
            ?>
            <form name="na" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mt-2">
                    <label for="nombre" class="form-label">Nombre Profesor</label>
                    <input type="text" class="form-control" name="nom_prof" placeholder="Introduzca el nombre" required>
                </div>
                <div class="mt-2">
                    <label for="sueldo" class="form-label">Sueldo Profesor</label>
                    <input type="number" class="form-control" name="sueldo" placeholder="Introduzca el sueldo">
                </div>
                <div class="mt-2">
                    <label for="fecha" class="form-label">Fecha Profesor</label>
                    <input type="text" class="form-control" name="fecha_prof" placeholder="Introduzca la fecha">
                </div>
                <div class="mt-2">
                    <label for="departamento" class="form-label">Departamento</label>
                    <select name="nom_dep" class="form-control">
                        <?php
                        foreach ($esteDepartamento as $valor) {
                            echo "<option>$valor</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mt-2">
                    <input type="submit" class="btn btn-primary" name="crear" value="Crear">
                    <a href="profesores.php" class="btn btn-secondary">Volver</a>
                    <input type="reset" class="btn btn-danger" value="Limpiar">
                </div>
            </form>
        </div>
    </body>

    </html>
<?php } ?>