<?php

session_start();

$mysqli = mysqli_connect('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$edit_state = false;
$name = '';
$location = '';


if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    
    mysqli_query($mysqli, "INSERT INTO data (name, location) VALUES('$name', '$location')") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Os dados foram salvos!";
    $_SESSION['msg_type'] = "success";
    
    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Os dados foram apagados!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}

if (isset ($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state = true;
    //selecionando dados e associando com o id
    $rec = mysqli_query($mysqli, "SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    $record = mysqli_fetch_array($rec);
    $name = $record['name'];
    $location = $record['location'];
    $id = $record['id'];
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];   

    mysqli_query($mysqli, "UPDATE data SET name='$name', location='$location' WHERE id=$id") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Os dados foram atualizados";
    $_SESSION['msg_type'] = "warning";
    
    header("location: index.php");
    
}

