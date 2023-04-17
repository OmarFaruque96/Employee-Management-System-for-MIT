<?php 

include '../inc/db.php';
include '../inc/functions.php';

if(isset($_POST['register'])){
	$email 		= $_POST['email'];
	$dept 		= $_POST['dept'];
	$password 	= $_POST['password'];

	$pass_len = strlen($password);
	$hass = sha1($password);
	if($pass_len < 8){
		header('Location: ../register.php?msg="Password length should be more than 8 letters long!"');
	}
	if(email_exist($email)){
		header('Location: ../register.php?msg="Email already exists. Please use another mail account."');
	}

	if(!email_exist($email) && $pass_len >= 8){
		$new_member_sql = "INSERT INTO users (email,dept,password) VALUES ('$email','$dept','$hass')";
		$res = mysqli_query($db,$new_member_sql);
		if($res){
			header('Location: ../login.php?msg="Registration Successful! Please Login now!"');
		}
	}
	
}