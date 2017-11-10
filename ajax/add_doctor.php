<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';
$role = $_POST['role'];
$salutation = trim($_POST['salutation']);
$password = $_POST['password'];
$user_name=trim($_POST['user_name']);
$doctor_full_name=trim($_POST['doctor_full_name']);
$doctor_address=mysql_real_escape_string(trim($_POST['doctor_address']));
$doctor_degree=mysql_real_escape_string(trim($_POST['doctor_degree']));
$doctor_affiliation=mysql_real_escape_string(trim($_POST['doctor_affiliation']));
$doctor_email=trim($_POST['doctor_email']);
$doctor_mobile=trim($_POST['doctor_mobile']);
$doctor_secondery_contact=trim($_POST['doctor_secondery_contact']);
$doc_reg_num=trim($_POST['doc_reg_num']);

if(($user_name == '') || ($doctor_full_name == '') || ($doctor_address == '') || ($doctor_degree == '') || ($doctor_affiliation == '') || 
		($doctor_email == '') || ($doctor_mobile == '') || ($doc_reg_num == '') ){
			$myObj->status = "fail";
			$myObj->message = "All fileds are mandatory.";
} else {
	//insert into user table
	
	$inert_query = "insert into user(user_name,	user_full_name,	user_password,	role) values(
	'$user_name','$doctor_full_name','".md5($password)."','$role')";
	mysql_query($inert_query) or die(mysql_error());
	//insert into doctor_master
	$insert_doc_master = "insert into doctor_master(salutation, user_name, doctor_full_name, doctor_address, doctor_degree, doctor_affiliation, doctor_email, doctor_mobile, doctor_secondery_contact, doc_reg_num) 
							values ( '$salutation', '$user_name','$doctor_full_name','$doctor_address','$doctor_degree','$doctor_affiliation','$doctor_email','$doctor_mobile','$doctor_secondery_contact','$doc_reg_num')";
	
	mysql_query($insert_doc_master) or die(mysql_error());
	
	$myObj->status = "success";
	$myObj->message = $insert_doc_master;
	
	
}
$myJSON = json_encode($myObj);

echo $myJSON;

?>