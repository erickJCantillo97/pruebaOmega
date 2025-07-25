<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Mega </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php
require_once 'Consulta.php';
if(isset($_GET['id'])){
    $consulta = new Consulta();
    $id = $_GET['id'];
    $data = $consulta->getDataById($id);
    $name = $data['name'];
    $avatar = $data['avatar'];
    $country = $data['country'];
}
?>

    <div class="container mt-2">
        <h3 class="text-center">Prueba de Mega 
            <a href="controller.php?api=reset" class="btn btn-primary float-end">Actualizar</a>
        </h3>
        <form action="controller.php" method="POST" enctype="multipart/form-data">
            <div class="row">
            <input type="text" name="id" value="<?php echo isset($id) ? $id : ''; ?>" hidden>
            <div class="col-3">
                <strong>Nombre</strong> 
                <input class="form-control" name="name" placeholder="Escriba su nombre" value="<?php echo isset($name) ? $name : ''; ?>">
            </div>
            <div class="col-3">
                <strong>Pais</strong>
                <input class="form-control" name="country" placeholder="Escriba su pais" value="<?php echo isset($country) ? $country : ''; ?>">
            </div>
            
            <div class="col-3">
                <strong>Avatar</strong>
                <input type="text" name="current_avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>" hidden>
                <input class="form-control" type="file" name="avatar" accept="image/*" placeholder="Seleccione una imagen">
            </div>
            </div>
            <input type="submit" value="Guardar" class="form-control btn btn-success mt-2">
        </form>
        <table class="table table-striped mt-2">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Nombre</th>
                    <th>Pais</th>
                    <th>Fecha de Creación</th>
                    <th>Aciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'Consulta.php';
                $consulta = new Consulta();
                $data = $consulta->getData();
                foreach ($data as $row) {
                    echo '<tr>';
                    echo '<td><img src="' . $row['avatar'] . '" class="rounded-circle" style="width: 30px;" alt="Avatar" /></td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['country'] . '</td>';
                    echo '<td>' . $row['createdAt'] . '</td>';
                    echo '<td> <a href="index.php?id=' . $row['id'] . '">Editar</a></td>';
                    echo '</tr>';
                }
                ?>
                
            </tbody>
        </table>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>