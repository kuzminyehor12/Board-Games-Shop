<?php
require_once "config.php";
require_once "functions.php";

if(isset($_POST)){
    $id = $_POST['vendorCode'];
    $value = $_POST['select_value'];
    $option = $_POST['selected_option'];
    
    if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `goods` WHERE `goods`.`vendorCode` = $id")) != 0){
        if($value == 0){
            if(mysqli_query($connection, "UPDATE `goods` SET `title` = '$option' WHERE `goods`.`vendorCode` = $id")){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
        else if($value == 1){
            if(mysqli_query($connection, "UPDATE `goods` SET `image` = '$option' WHERE `goods`.`vendorCode` = $id")){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit(); 
            }
        }
        else if($value == 2){
            if(mysqli_query($connection, "UPDATE `goods` SET `price` = '$option' WHERE `goods`.`vendorCode` = $id")){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
        else if($value == 3){
            if(mysqli_query($connection, "UPDATE `goods` SET `quantity` = '$option' WHERE `goods`.`vendorCode` = $id")){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>