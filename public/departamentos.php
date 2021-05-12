<?php
require "../vendor/autoload.php";

use Clases\Departamentos;

$departamentos = new Departamentos();
$datos = $departamentos->devolverTodo();
$departamentos = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Departamentos</title>
</head>

<body style="background-color: lightblue;">
    <h3 class="text-center bg-dark text-light">Departamentos</h3>
    <div class="container mt-3">
    <?php
        require "resources/mensaje.php";
    ?>
    <a href="crearDepartamento.php" class="btn btn-success mt-2">Nuevo Departamento</a>
        <table class="table table-dark table-striped mt-2">
            <thead>
                <tr>
                    <th scope="col">Departamento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($file = $datos->fetch(PDO::FETCH_OBJ)) {
                    echo <<< TEXTO
                        <tr>
                            <th scope="row">{$file->nom_dep}</th>
                            <td>
                                <form name="a" method="POST" class="form-inline" action="borrarDepartamento.php">
                                    <a href="editarDepartamento.php?id={$file->id}" class="btn btn-primary">Editar</a>
                                    <input type="hidden" name="id" value="{$file->id}">
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    TEXTO;
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Volver</a>
    </div>

</body>

</html>