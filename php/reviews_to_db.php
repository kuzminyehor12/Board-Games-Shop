<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";
    
    if(isset($_POST) && isset($_SESSION)){
        $desc = htmlspecialchars($_POST['review']);
        $username = $_SESSION['username']['username'];

        if(mysqli_query($connection, "INSERT INTO `reviews`(`username`, `description`) VALUES ('$username', '$desc')")){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else{
            echo mysqli_error($connection);
        }
    }
    else{
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>