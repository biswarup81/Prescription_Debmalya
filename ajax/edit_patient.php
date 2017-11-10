<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
	
    $admin = new admin();
	$user_type = $_SESSION['user_type']  ;

				
				$gender = $_POST['gender'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$addr = $_POST['addr'];
				$city = $_POST['city'];
				$patient_id = $_POST['patientId'];
				
				$user_name= $_SESSION['logged_in_user_id'];
				
				$cellnum = $_POST['cellnum'];
				$altcellnum = $_POST['altcellnum'];
				$email = $_POST['email'];
				$dob = date("Y-m-d", strtotime($_POST['theDate']));
				$max_patient_id = $admin->getMaxPatientId($chamber_name, $doc_name);
				
				$sql1 = "update patient set GENDER = '$gender' ,patient_first_name = '$fname',
				patient_last_name = '$lname', patient_address = '$addr', patient_city = '$city', patient_dob = '$dob' , patient_cell_num = '$cellnum',
				patient_alt_cell_num = '$altcellnum', patient_email = '$email' where patient_id = '$patient_id' ";
				mysql_query($sql1) or die(mysql_error());
				
				
				
				
				echo "$fname $lname data saved successfully. <a class='btn btn-primary' href='processData.php?patient_id=".$patient_id."&chamber_name=".$chamber_name."&doc_name=".$doc_name."'>Create Visit !!</a>";
		
	} else {
	echo "Invalid session. Login again.";
}

?>
