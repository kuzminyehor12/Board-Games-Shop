<?php 
require_once "config.php";
require_once "functions.php";

if(isset($_POST)){
    $id = $_POST['vendorCode'];
    if(mysqli_query($connection, "DELETE FROM `goods` WHERE `goods`.`vendorCode` = $id")){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>