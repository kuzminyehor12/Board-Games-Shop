<?php
session_start();
require_once "config.php";
require_once "functions.php";

if(isset($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);

    $dbemails = query_to_array("SELECT `email` FROM `users`");
    $dbpasses = query_to_array("SELECT `password` FROM `users`");

    for($i = 0; $i < count($dbemails); $i++){
        if(strcmp($email, $dbemails[$i]["email"]) == 0 && strcmp($pass, $dbpasses[$i]["password"]) == 0){
			$_SESSION['email'] = $email;
			$_SESSION['username'] = query_to_array("SELECT `username` FROM `users` WHERE `email` = '$email'")[0];
			$_SESSION['phone'] = query_to_array("SELECT `phone` FROM `users` WHERE `email` = '$email'")[0];
            $_SESSION['priority'] = query_to_array("SELECT `priority` FROM `users` WHERE `email` = '$email'")[0];
            echo json_encode(array('result' => 'success')); 
            exit();
        }
    }
    echo json_encode(array('result' => 'error'));
    exit();
}

?>