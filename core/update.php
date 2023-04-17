<?php 

include '../inc/db.php';
include '../inc/functions.php';

if(isset($_POST['update_cost'])){
	$editid = $_POST['editid'];
	$costpurpose = $_POST['costpurpose'];
	$paidby 	 = $_POST['paidby'];
	$amount 	 = $_POST['amount'];
	$oldfiles 	 = $_POST['oldfiles'];
	$file_name   =  $_FILES['image']['name'];
	// $tmp_name    =  $_FILES['image']['tmp_name'];

	if(!empty($file_name)){

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

		$newfiles = $oldfiles.$filenames;

		$update_sql = "UPDATE dailycost SET cost_purpose='$costpurpose', total_amount='$amount', paid_by='$paidby', money_receipt='$newfiles' WHERE ID='$editid'";
		
	}else{
		$update_sql = "UPDATE dailycost SET cost_purpose='$costpurpose', total_amount='$amount', paid_by='$paidby' WHERE ID='$editid'";
	}
	$data_feedback = mysqli_query($db,$update_sql);
	if($data_feedback){
		header('Location: ../dailycost.php');
	}else{
		die('Daily cost update Error.'.mysqli_error($db));
	}
}
?>
