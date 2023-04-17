<?php 
include '../inc/db.php';
include '../inc/functions.php';

if(isset($_POST['update'])){
	$username 		= $_POST['name'];
	$gender 		= $_POST['gender'];
	$about 			= $_POST['about'];
	$file_name 		= $_FILES['image']['name'];
	$tmp_name 		= $_FILES['image']['tmp_name'];
	$email 			= $_POST['email'];
	$password 		= $_POST['password'];
	$biodata 		= $_POST['biodata'];
	$phone 			= $_POST['phone'];
	$emergency 		= $_POST['emergency'];
	$dob 			= $_POST['dob'];
	$editid 		= $_POST['editid'];
	$dept 		    = $_POST['dept'];
	$memberlevel 	= $_POST['memberlevel'];
	$employee_id 	= $_POST['employee_id'];
	$position 		= $_POST['position'];
	$jdate 			= $_POST['jdate'];
	$salary 		= $_POST['salary'];
	$target 		= $_POST['target'];
	$level 			= $_POST['percentagelevel'];

	if(!empty($file_name) && !empty($password)){

		$hash = sha1($password);
		if(is_img($file_name)){
			$file_name = rand().$file_name;
			move_uploaded_file($tmp_name, '../images/users/'.$file_name);

			$up_sql = "UPDATE users SET username='$username', password='$hash', gender='$gender', phone='$phone', address='$about', dob='$dob', emergency_content='$emergency', photo='$file_name', biodata='$biodata' WHERE ID='$editid'";
			$res = mysqli_query($db,$up_sql);
			if($res){
				header('Location: ../profile.php?action=showprofile');
			}else{
				die('User information update error!'.mysqli_error($db));
			}
		}
	}
	elseif(!empty($file_name) && empty($password)){

		
		if(is_img($file_name)){
			$file_name = rand().$file_name;
			move_uploaded_file($tmp_name, '../images/users/'.$file_name);

			$up_sql = "UPDATE users SET username='$username', gender='$gender', phone='$phone', address='$about', dob='$dob', emergency_content='$emergency', photo='$file_name', biodata='$biodata' WHERE ID='$editid'";
			$res = mysqli_query($db,$up_sql);
			if($res){
				header('Location: ../profile.php?action=showprofile');
			}else{
				die('User information update error!'.mysqli_error($db));
			}
		}
	}
	elseif(empty($file_name) && !empty($password)){

		$hash = sha1($password);
		
		$up_sql = "UPDATE users SET username='$username', password='$hash',gender='$gender', phone='$phone', address='$about', dob='$dob', emergency_content='$emergency', biodata='$biodata' WHERE ID='$editid'";
		$res = mysqli_query($db,$up_sql);
		if($res){
			header('Location: ../profile.php?action=showprofile');
		}else{
			die('User information update error!'.mysqli_error($db));
		}
	}else{
		$up_sql = "UPDATE users SET username='$username', gender='$gender', phone='$phone', address='$about', dob='$dob', emergency_content='$emergency', biodata='$biodata' WHERE ID='$editid'";
		$res = mysqli_query($db,$up_sql);
		if($res){
			header('Location: ../profile.php?action=showprofile');
		}else{
			die('User information update error!'.mysqli_error($db));
		}
	}

}