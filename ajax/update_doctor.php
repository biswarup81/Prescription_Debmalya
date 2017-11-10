<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';

 $salutation = trim($_POST['salutation']);

$user_name=trim($_POST['user_name']);
$doctor_full_name=trim($_POST['doctor_full_name']);
$doctor_address=mysql_real_escape_string(trim($_POST['doctor_address']));
$doctor_degree=mysql_real_escape_string(trim($_POST['doctor_degree']));
/* $doctor_degree2=mysql_real_escape_string(trim($_POST['doctor_degree2']));
$doctor_degree3=mysql_real_escape_string(trim($_POST['doctor_degree3']));
$doctor_degree = "";
if($doctor_degree1 != ""){
	$doctor_degree .= $doctor_degree1."<br>";
}
if($doctor_degree2 != ""){
	$doctor_degree .= $doctor_degree2."<br>";
} 
if($doctor_degree3 != ""){
	$doctor_degree .= $doctor_degree3."<br>";
}  */

$doctor_affiliation=mysql_real_escape_string(trim($_POST['doctor_affiliation']));
$doctor_email=trim($_POST['doctor_email']);
$doctor_mobile=trim($_POST['doctor_mobile']);
$doctor_secondery_contact=trim($_POST['doctor_secondery_contact']);
$doc_reg_num=trim($_POST['doc_reg_num']);
$mode = $_POST['mode'];
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name']) &&  ($_POST['mode'] == 'UPDATE')){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
	if(($user_name == '') || ($doctor_full_name == '') || ($doctor_address == '') || ($doctor_degree == '') || ($doctor_affiliation == '') ||
			($doctor_email == '') || ($doctor_mobile == '') || ($doc_reg_num == '') ){
				$myObj->status = "fail";
				$myObj->message = "All fileds are mandatory.";
	} else {
		
		//update into doctor_master
		$update_doc_master = "update doctor_master set salutation = '$salutation' , doctor_full_name = '$doctor_full_name', doctor_address='$doctor_address', doctor_degree='$doctor_degree', 
								doctor_affiliation='$doctor_affiliation', doctor_email='$doctor_email', doctor_mobile='$doctor_mobile', doctor_secondery_contact='$doctor_secondery_contact', doc_reg_num='$doc_reg_num'  where 
								user_name='$doc_name' ";
		echo $update_doc_master;
		
		mysql_query($update_doc_master) or die(mysql_error());
		
		echo "Success";
		
		
	}
	
} else {
	
	echo "You are not authorize to perform operation";
} 


?>