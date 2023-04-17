<?php 

include '../inc/db.php';

if(isset($_POST['custom-attendance'])){
	$employee_id 	= $_POST['employee_id'];
	$entry 			= $_POST['entry'];
	$exit		 	= $_POST['exit'];
	$comments 		= $_POST['comments'];

	$att_sql = "INSERT INTO take_attendance (employee_id, cdate, entry_time, exit_time, status, comment) VALUES ('$employee_id', now(), '$entry', '$exit', '0','$comments')";
	$result = mysqli_query($db,$att_sql);

	if($result){
		header('Location: ../attendance.php?action=single');
	}else{
		die('Take Manual Attendance Error!'.mysqli_error($db));
	}
}