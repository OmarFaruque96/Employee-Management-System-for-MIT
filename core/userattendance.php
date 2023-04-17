<?php 

include '../inc/db.php';
include '../inc/functions.php';

session_start();

date_default_timezone_set('Asia/Dhaka');
$current_time = date('H:i:s');
$userip = getUserIpAddr();

if(isset($_POST['takeatt'])){
	$userid = $_SESSION['ID'];

	$employee_id = find_col('employee_id', 'users', $userid, 'ID');

	//echo $employee_id;
	$entry_insert = "INSERT INTO take_attendance (employee_id, cdate, entry_time, status, ip) VALUES ('$employee_id', now(), '$current_time', '3', '$userip')";
	$res = mysqli_query($db,$entry_insert);
	if($res){
		header('Location: ../profile.php?action=showprofile');
	}else{
		header('Location: ../profile.php');
	}
}


if(isset($_POST['exitatt'])){

	$userid = $_SESSION['ID'];
	$eemployee_id = find_col('employee_id', 'users', $userid, 'ID');

	$last_att = "SELECT ID from take_attendance WHERE employee_id='$eemployee_id' ORDER BY ID DESC LIMIT 1";

	$idres = mysqli_query($db,$last_att);
	$ids = mysqli_fetch_assoc($idres)['ID'];

	$exit_insert = "UPDATE take_attendance SET exit_time = now() WHERE ID ='$ids'";
	//echo $exit_insert;
	$res = mysqli_query($db,$exit_insert);
	if($res){
		header('Location: ../profile.php?action=complete');
	}else{
		header('Location: ../profile.php');
	}

}
