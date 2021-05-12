<?php
    require "../vendor/autoload.php";
    use Clases\Departamentos;

    if (isset($_POST['crear'])) {
        $nombre = trim($_POST['nom_dep']);
    
        if (strlen($nombre) == 0) {
            $_SESSION['mensaje'] = "Rellene los campos";
            header("Location:{$_SERVER['PHP_SELF']}");
            die();
        }
    
        $esteDepartamento = new Departamentos();
        if (!$esteDepartamento->existeDepartamento(strtoupper($nombre))) {
            $esteDepartamento->setNom_dep(strtoupper($nombre));
    
            $esteDepartamento->create();
            $esteDepartamento = null;
            $_SESSION['mensaje'] = "Departamento añadido correctamente";
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
    <title>Añadir</title>
</head>

<body style="background-color: lightblue;">
    <h3 class="text-center bg-dark text-light">Nuevo Departamento</h3>
    <div class="container mt-3">
        <?php
        require "resources/mensaje.php";
        ?>
        <form name="na" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="mt-2">
                <label for="nombre" class="form-label">Nombre Departamento</label>
                <input type="text" class="form-control" name="nom_dep" placeholder="Introduzca el nombre del departamento" required>
            </div>
            <div class="mt-2">
                <input type="submit" class="btn btn-primary" name="crear" value="Crear">
                <a href="departamentos.php" class="btn btn-secondary">Volver</a>
                <input type="reset" class="btn btn-danger" value="Limpiar">
            </div>
        </form>
</body>

</html>
<?php } ?>