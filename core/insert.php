<?php 

include '../inc/db.php'; 
include '../inc/functions.php'; 

// daily cost add function
if(isset($_POST['add_cost'])){
	$costpurpose = $_POST['costpurpose'];
	$paidby 	= $_POST['paidby'];
	$amount 	= $_POST['amount'];
	
	//$file_name =  $_FILES['image']['name'];
	//$tmp_name =  $_FILES['image']['tmp_name'];
	// $file_size = $_FILES['image']['size'];

	// $slited_names = explode('.', $file_name);
	// $extn = strtolower(end($slited_names));

	// $extensions = array('png','jpg'); 


		$files 		= array_filter($_FILES['image']['name']); 
		$total_count = count($_FILES['image']['name']);
		for( $i=0 ; $i < $total_count ; $i++ ) {
		   $tmpFilePath = $_FILES['image']['tmp_name'][$i];
		   if ($tmpFilePath != ""){

		   	$updatename = rand().$_FILES['image']['name'][$i];
		      $newFilePath = "../images/moneyreceipt/" . $updatename;
		      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
		         $filenames.= $updatename.';';
		      }
		   }
		}

		// $file_name = rand().$file_name;
		// move_uploaded_file($tmp_name, '../images/moneyreceipt/'.$file_name);

		$cost_sql = "INSERT INTO `dailycost` (`cost_date`, `cost_purpose`, `total_amount`, `paid_by`, `money_receipt`) VALUES (now(), '$costpurpose', '$amount', '$paidby', '$filenames');";
		$data_feedback = mysqli_query($db,$cost_sql);
		if($data_feedback){
			header('Location: ../dailycost.php');
		}else{
			echo 'Data Insert Error!';
		}

	
}


// add employee information
if(isset($_POST['add_employee'])){
	$name 		= $_POST['name'];
	$gender 	= $_POST['gender'];
	$email 		= $_POST['email'];
	$password 	= $_POST['password'];
	$dept 		= $_POST['dept'];
	//$employee_type = $_POST['employee_type'];
	$employee_id = $_POST['employee_id'];
	$position 	= $_POST['position'];
	$joining 	= $_POST['joining'];
	$salary 	= $_POST['salary'];
	$target 	= $_POST['target'];
	$level 		= $_POST['level'];
	$phone 		= $_POST['phone'];
	$shift 		= $_POST['shift'];
	$entry 		= $_POST['entry'];
	$exit 		= $_POST['exit'];
	$dob 		= $_POST['dob'];
	$holiday 	= $_POST['holiday'];
	$filenames = '';

	if(duplicate_mail_check($email) === false){
		$files 		= array_filter($_FILES['image']['name']); 
		$total_count = count($_FILES['image']['name']);
		for( $i=0 ; $i < $total_count ; $i++ ) {
		   $tmpFilePath = $_FILES['image']['tmp_name'][$i];
		   if ($tmpFilePath != ""){
		      $newFilePath = "../images/documents/" . $_FILES['image']['name'][$i];
		      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
		         $filenames.= $_FILES['image']['name'][$i].';';
		      }
		   }
		}

		$hash_pass = sha1($password);

		$add_sql = "INSERT INTO users (username,email,password,dept,position,employee_type,employee_id,phone,address,dob,emergency_content,photo,official_document,joining_date,biodata,usertype,status) VALUES ('$name', '$email', '$hash_pass', '$dept', '$position', '0', '$employee_id', '$phone', '','$dob','', '','$filenames', '','','1','1')";
		$insert_res = mysqli_query($db,$add_sql);

		if($insert_res){
			//$id = find_col('ID', 'users', '$email', 'email');
			$findid = "SELECT ID from users WHERE email = '$email' LIMIT 1";
			$id_res = mysqli_query($db,$findid);
			$id = mysqli_fetch_assoc($id_res)['ID'];
			$schedule = "INSERT INTO attendance (user_id, shift, entry_time, exit_time, holiday) VALUES('$id', '$shift', '$entry', '$exit', '$holiday')";

			$sc_res = mysqli_query($db,$schedule);
			$salary = "INSERT INTO salary (user_id, current_salary, target_per_month, bonus_level, update_history) VALUES('$id', '$salary', '$target', '$level', '')";
			$sa_res = mysqli_query($db,$salary);
			if($sc_res){
				if($sa_res){
					header('Location: ../employee.php?msg=Data inserted successfully!');
				}else{
					die('Data Insert Error in salary!'.mysqli_error($db));
				}
			}else{
				die('Data Insert Error in Schedule!'.mysqli_error($db));
			}
		}else{
			die('Data Insert Error for new user!'.mysqli_error($db));
		}
	}else{
		header('Location: ../employee.php?mailmsg=Email alredy exists!&action=add');
	}

	
}