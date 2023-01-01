<?php
    require_once "config.php";
    require_once "functions.php";

    if(isset($_POST)){
        $id = htmlspecialchars($_POST['id']);
        $title = htmlspecialchars($_POST['title']);
        $image = htmlspecialchars($_POST['image']);
        $short_desc = htmlspecialchars($_POST['short_desc']);
        $long_desc = htmlspecialchars($_POST['long_desc']);
        $price = htmlspecialchars($_POST['price']);
        $quantity = htmlspecialchars($_POST['quantity']);
        $brandID = $_POST['brand'];
        //$image = str_replace(".jpg", "", $image);
        if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `brands`")) != 0){
            if(mysqli_query($connection, "INSERT INTO goods(`vendorCode`, `title`, `image`, `short_description`, `long_description`, `quantity`, `brandID`, `price`) VALUES('$id', '$title', '$image', '$short_desc', '$long_desc', '$quantity', '$brandID', '$price')")){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else{
                echo mysqli_error($connection);
            }
        }
        else{
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        
    }
    else{
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>