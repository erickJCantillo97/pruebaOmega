<?php 


require_once 'Consulta.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $consulta = new Consulta();
    $file_name = pathinfo($_FILES['avatar']['name'], PATHINFO_FILENAME);

    $avatar = uniqid($file_name . '_'). pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $path = 'Img/' . '.'. $avatar;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
    if(isset($_POST['id']) && !empty($_POST['id'])){
        if(empty($_FILES['avatar']['name'])){
            $path = $_POST['current_avatar'];
        }
        $consulta->update($_POST['id'], $_POST['name'], $path, $_POST['country']);
    } else {

        $consulta->store($_POST['name'], $path, $_POST['country'], date('Y-m-d H:i:s'));
    }

    header("Location: index.php");
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $consulta = new Consulta();
    $consulta->resetData();
    $consulta->getDataApi();
    header("Location: index.php");
}

if(isset($_GET['update'])){
    $consulta = new Consulta();
    $id = $_GET['id'];
    $name = $_POST['name'];
    $avatar = $_POST['avatar'];
    $country = $_POST['country'];
    $consulta->update($id, $name, $avatar, $country);
    header("Location: index.php");
}
?>