<?php 
	
	$db = mysqli_connect('localhost', 'root', '', 'ems');

	if($db){
		// echo 'Database Connection Established!';
	}
	else{
		echo 'Database connection error!';
	}
		
?>