<?php
include_once "./inc/datacon.php";

include_once './inc/header.php';

?>

  <body>
	
    <div class="container">
    <?php if(isset($_GET['role'])){
    	$role = $_GET['role'];
    	
    	if($role == 'DOCTOR'){
    ?>
	<h1>Doctor registration</h1>
      <form id="signup_doc_form" class="form-horizontal" >
                    <input type="hidden" name = "role" value="DOCTOR">
                      <div class="alert alert-danger" role="alert" id="signup_alert_2" hidden="true">
				        
				      </div>
					  <div class="form-group">
					    <label class="col-sm-2 control-label">Salutation</label>
					    <div class="col-sm-2">
					      <select class="form-control" name="salutation" id="salutation">
                            
                            <option value="Dr.">Dr.</option>
                            <option value="Prof.">Prof.</option>
                            
                        </select>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doctor_full_name" class="col-sm-2 control-label">Name</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="doctor_full_name" id="doctor_full_name" placeholder="Enter Name" required value="">
					    </div>
					  </div>
					 <div class="form-group">
					    <label for="user_name" class="col-sm-2 control-label">User ID</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Id" required>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="password" class="col-sm-2 control-label">Password</label>
					    <div class="col-sm-6">
					      <input type="password" class="form-control" name="password" id="password" placeholder="Choose Password" required>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doctor_degree" class="col-sm-2 control-label">Degree</label>
					    <div class="col-sm-6">
					      <textarea class="form-control" rows="3" name="doctor_degree" id="doctor_degree" placeholder="MBBS (Hons), DTM&H, MD (Medicine), DM (Endocrinology), MRCP
																											Fellow, American College of Endocrinology (FACE)
																											Consultant Endocrinologist & Diabetologist
																											Member: Endocrine Society (USA), AACE (USA)" required></textarea>
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="doctor_affiliation" class="col-sm-2 control-label">Affiliation</label>
					    <div class="col-sm-6">
					      <textarea class="form-control" rows="3" name="doctor_affiliation" id="doctor_affiliation" placeholder="Enter Affiliation" required></textarea>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doc_reg_num" class="col-sm-2 control-label">Registration number</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="doc_reg_num" id="doc_reg_num" placeholder="Enter Registration number" required>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doctor_mobile" class="col-sm-2 control-label">Mobile number</label>
					    <div class="col-sm-6">
					      <input type="tel" class="form-control" name="doctor_mobile" id="doctor_mobile" placeholder="Enter Mobile number" required>
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="doctor_secondery_contact" class="col-sm-2 control-label">Landline number</label>
					    <div class="col-sm-6">
					      <input type="tel" class="form-control" name="doctor_secondery_contact" id="doctor_secondery_contact" placeholder="Enter Landline number" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doctor_address" class="col-sm-2 control-label">Street Address</label>
					    <div class="col-sm-6">
					    	
					    	<textarea class="form-control" name="doctor_address" id="doctor_address" placeholder="Enter Address" required></textarea>
					      
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="doctor_email" class="col-sm-2 control-label">E-Mail</label>
					    <div class="col-sm-6">
					      <input type="email" class="form-control" name="doctor_email" id="doctor_email" placeholder="Enter E-Mail" required>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<button id="signup" class="btn btn-default"  name="signup" >Sign-up</button>
					    </div>
					  </div>
					</form>
                   <!--END of form-->
                   <div class="alert alert-info" role="alert" id="signup_doc_form_result" hidden="true">
				        
				   </div>
				   <?php } else if($role == 'CHEMIST') {
				   	include_once './makeprescription/signup_user.php';
				   } else if($role == 'USER') {
				   	include_once './makeprescription/signup_user.php';
				   } else { echo "You are not authorize to perform any operation on this page.";}?>
<?php } else { echo "Please select your role first. <a href='./select_role.php' >select role</a>";}?>
    </div> <!-- /container -->
    <?php include_once './inc/footer.php';?>
  </body>
</html>
