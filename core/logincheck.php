<?php

include '../inc/functions.php';
session_start();

if (isset($_POST['login'])) {
	$email = $_POST['login-email'];
	$password = $_POST['login-password'];
	$hass_password = sha1($password);

	//$ipaddress = getUserIpAddr();

	$login_user = "SELECT * FROM users WHERE email='$email' AND status = 1";
	$login_res = mysqli_query($db,$login_user);
	while($row = mysqli_fetch_assoc($login_res)){
		$_SESSION['username'] 	= $row['username'];
		$_SESSION['email'] 		= $row['email'];
		$pass 					= $row['password'];
		$usertype 				= $row['usertype'];
		$_SESSION['ID'] 		= $row['ID'];

		if($email == $_SESSION['email'] && $hass_password == $pass){
			if($usertype > 1){
				header('Location: ../dashboard.php');
			}else{
				header('Location: ../profile.php?action=viewprofile');
			}
			
		}elseif($email != $_SESSION['email'] && $hass_password != $pass){
			header('Location: ../index.php');
		}else{
			header('Location: ../index.php');
		}
	}

}