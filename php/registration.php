<?php
session_start();

if (isset($_POST) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["telephone_number"]) && !empty($_POST["age"]) && !empty($_POST["password"]) && !empty($_POST["confirm"])) {
	$email = htmlspecialchars($_POST["email"]);
	$username = htmlspecialchars($_POST["username"]);
	$phone = htmlspecialchars($_POST["telephone_number"]);
	$age = htmlspecialchars($_POST["age"]);
	$pass = htmlspecialchars($_POST["password"]);
	$confirm = htmlspecialchars($_POST["confirm"]);
   
	$errors = array();
   
	$valid_email = "/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/";
	$valid_phone = "/^[0-9\-\(\)\/\+\s]{10,}$/";
	$valid_pass = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";
   
	if(preg_match($valid_email, $email) == 0) $errors[0] = 1;
	if($username == "")  $errors[1] = 2;
	if($age < 0 || $age > 200) $errors[2] = 3;
	if(preg_match($valid_phone, $phone) == 0) $errors[3] = 4;
	if(preg_match($valid_pass, $pass) == 0 || strcmp($pass, $confirm) != 0) $errors[4] = 5;

	if(empty($errors)){
		require_once "config.php";
	    if (mysqli_query($connection, "INSERT INTO `users`(`email`, `username`, `phone`, `age`, `password`, `priority`) VALUES ('$email', '$username', '$phone', $age, '$pass', 'user')")) {
			$_SESSION['email'] = $email;
			$_SESSION['username'] = $username;
			$_SESSION['phone'] = $phone;
			$_SESSION['priority'] = 'user';
		    echo json_encode(array('result' => 'success'));
	   } else {
		   echo mysqli_error($connection);
	   }
	}
	else{
	   echo json_encode(array('result' => 'error', 'error_number' => $errors));
	}
   
   }
?>