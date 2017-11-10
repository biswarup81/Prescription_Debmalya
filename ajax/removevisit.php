<?php
include "../inc/datacon.php";
include '../classes/admin_class.php';

if(isset($_SESSION['user_type']) &&  isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name']) && isset($_SESSION['logged_in_user_id'])) {
    
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
    $user_name= $_SESSION['logged_in_user_id'];
    
	$user_type = $_SESSION['user_type']  ;
	if($user_type == 'DOCTOR' || $user_type == 'RECEPTIONIST'){
	$visit_id = $_GET['VISIT_ID'];
	
	$query = "UPDATE visit SET VISITED = 'cancel' WHERE VISIT_ID = '$visit_id' and chamber_id = '$chamber_name' and doc_id = '$doc_name' ";
	echo $query;
	mysql_query($query) or die(mysql_error());
	}
	header("location:../visit_list.php");
} else {
    echo "you are not authorized to perform any operation";
}

	
?>