<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';

	
    $admin = new admin();

			//if(isset($_POST['CREATE_PATIENT_DATA'])){
    			$role = $_POST['role'];
				$gender = $_POST['gender'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$full_name = $fname." ".$lname;
				$addr = $_POST['addr'];
				$city = $_POST['city'];
				$uid = $_POST['uid'];
				$password = $_POST['password'];
				$cellnum = $_POST['cellnum'];
				$altcellnum = $_POST['altcellnum'];
				$email = $_POST['email'];
				$dob = date("Y-m-d", strtotime($_POST['theDate']));
				
				
				
				$sql1 = "insert into user_master (GENDER,user_first_name,
				user_last_name, user_address, user_city, user_dob, user_cell_num,
				user_alt_cell_num, user_email, create_date)
				values('$gender','$fname', '$lname', '$addr', '$city', '$dob' ,'$cellnum', '$altcellnum', 
                        '$email',  NOW() )";
				mysql_query($sql1) or die(mysql_error());
			
				//Insert into user table
				
				$inert_query = "insert into user(user_name,	user_full_name,	user_password,	role) values(
				'$uid','$full_name','".md5($password)."','$role')";
				mysql_query($inert_query) or die(mysql_error());
				
				echo "Dear  $fname $lname !! Registration is successful. <a class='btn btn-primary' href='./index_login.php'>Login Now !!</a>";
				
			//}
		

?>
