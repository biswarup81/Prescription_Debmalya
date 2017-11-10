<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
	
    $admin = new admin();
	$user_type = $_SESSION['user_type']  ;
	if($user_type == 'DOCTOR' || $user_type == 'RECEPTIONIST'){
		if($user_type == 'RECEPTIONIST'){
			//if(isset($_POST['CREATE_PATIENT_DATA'])){
				
				$gender = $_POST['gender'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$addr = $_POST['addr'];
				$city = $_POST['city'];
				//$dob =  $_POST['theDate'];
				
				//$chamber_name = $_POST['chamber_id'];
				//$doc_name= $_POST['doc_id'];
				$user_name= $_SESSION['logged_in_user_id'];
				
				$cellnum = $_POST['cellnum'];
				$altcellnum = $_POST['altcellnum'];
				$email = $_POST['email'];
				$dob = date("Y-m-d", strtotime($_POST['theDate']));
				$max_patient_id = $admin->getMaxPatientId($chamber_name, $doc_name);
				
				$sql1 = "insert into patient (patient_id, GENDER,patient_first_name,
				patient_last_name, patient_address, patient_city, patient_dob, patient_cell_num,
				patient_alt_cell_num, patient_email, data_entry_date, chamber_id, created_by_user_id, create_date, doc_id)
				values('$max_patient_id','$gender','$fname', '$lname', '$addr', '$city', '$dob' ,'$cellnum', '$altcellnum', 
                        '$email', NOW(),  '$chamber_name', '$user_name',  NOW() ,'$doc_name')";
				mysql_query($sql1) or die(mysql_error());
				
				
				//$id = mysql_insert_id();
				$id = $max_patient_id;
				//$sql2 = "insert into visit (PATIENT_ID, VISIT_DATE, APPOINTMENT_TO_DOC_NAME) values('$id', NOW(), '')";
				//mysql_query($sql2) or die(mysql_error());
				//$visit_id = mysql_insert_id();
				
				/*$sql3 = "insert into patient_health_details_by_receptionist (patient_id) values('$id')";
				 mysql_query($sql3) or die(mysql_error());*/
				
				echo "$fname $lname data saved successfully. <a class='btn btn-primary' href='processData.php?patient_id=".$id."&chamber_name=".$chamber_name."&doc_name=".$doc_name."'>Create Visit !!</a>";
			//}
		} else {
			$patient_name = $_GET['patient_name'];
			$sex = $_GET['sex'];
			$dob = $_GET['dob'];
			$cell = $_GET['cell'];
			$patient = $admin->preparepatientDatails($patient_name);
			$fname = $patient->fname;
			$lname = $patient->lname;
			//$chamber_name = $_GET['chamber_id'];
			//$doc_name= $_GET['doc_id'];
			$user_name= $_SESSION['logged_in_user_id'];
			$max_patient_id = $admin->getMaxPatientId($chamber_name, $doc_name);
			$sql1 = "insert into patient (patient_id, GENDER,patient_first_name, patient_last_name , patient_dob ,patient_cell_num,
			        data_entry_date, chamber_id, created_by_user_id, create_date, doc_id) 
			        values('$max_patient_id', '$sex','$fname','$lname', '$dob' ,'$cell', NOW(),  '$chamber_name', '$user_name',  NOW() ,'$doc_name')";
			//echo $sql1;
			mysql_query($sql1) or die(mysql_error());
			
			$id = $max_patient_id;
			
			echo "$fname $lname data saved successfully. <a class='btn btn-primary' href='processData.php?patient_id=".$id."&chamber_name=".$chamber_name."&doc_name=".$doc_name."'>Create Visit !!</a>";
		}
		
	}else {
		echo "You are not permitted to go this operation.";
	}
} else {
	echo "Invalid session. Login again.";
}

?>
