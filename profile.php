<?php include_once "./inc/datacon.php";
include_once "./inc/header.php"; 
include './classes/admin_class.php';
include './classes/prescription_header.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
	$header = new Header($doc_name,$chamber_name);
	$admin = new admin();
?>

    <?php include './inc/dashboard_topnav.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <?php include './inc/dashboard_sidenav.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">My Profile</h1>

          
          
          
          <div id="accordion">
			  <h3 class="bg-primary">My Details</h3>
			  <div>
			    <form id="update_doc_form" class="form-horizontal">
                    <input type="hidden" name = "role" value="DOCTOR">
                      <div class="alert alert-danger" role="alert" id="update_alert_2" hidden="true">
				        
				      </div>
					  <div class="form-group">
					    <label class="col-sm-2 control-label">Salutation</label>
					    <div class="col-sm-1">
						      <input type="text" class="form-control" name="salutation" id="salutation" placeholder="Enter Name" required value="<?php echo $header->salutation; ?>" readonly>					      
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doctor_full_name" class="col-sm-2 control-label">Name</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="doctor_full_name" id="doctor_full_name" placeholder="Enter Name" required value="<?php echo $header->doctor_full_name; ?>" readonly>
					    </div>
					  </div>
					 <div class="form-group">
					    <label for="user_name" class="col-sm-2 control-label">User ID</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Id" value="<?php echo $header->user_name; ?>" required readonly>
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="doctor_degree" class="col-sm-2 control-label">Degree</label>
					    <div class="col-sm-6">
					      <textarea class="form-control" name="doctor_degree" id="doctor_degree" required rows="4"><?php echo $header->doctor_degree ; ?></textarea>
							<script>
													                // Replace the <textarea id="editor1"> with a CKEditor
													                // instance, using default configuration.
													                CKEDITOR.replace( 'doctor_degree' );
													            </script>									
					    </div>
					    
					  </div>
					 <!--   <div class="form-group">
					    <label for="doctor_degree2" class="col-sm-2 control-label">Degree line 2</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="doctor_degree2" id="doctor_degree2" required value="<?php echo $header->doctor_degree; ?>">
																
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doctor_degree3" class="col-sm-2 control-label">Degree line 3</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="doctor_degree3" id="doctor_degree3" required value="<?php echo $header->doctor_degree; ?>">
																
					    </div>
					  </div> -->
					   <div class="form-group">
					    <label for="doctor_affiliation" class="col-sm-2 control-label">Affiliation</label>
					    <div class="col-sm-6">
					      <textarea class="form-control" rows="3" name="doctor_affiliation" id="doctor_affiliation" placeholder="Enter Affiliation" required><?php echo $header->doctor_affiliation; ?></textarea>
					      <script>
													                // Replace the <textarea id="editor1"> with a CKEditor
													                // instance, using default configuration.
													                CKEDITOR.replace( 'doctor_affiliation' );
													            </script>
					    </div>
					    
					  </div>
					  <div class="form-group">
					    <label for="doc_reg_num" class="col-sm-2 control-label">Registration number</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="doc_reg_num" id="doc_reg_num" placeholder="Enter Registration number" required value="<?php echo $header->doc_reg_num; ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doctor_mobile" class="col-sm-2 control-label">Mobile number</label>
					    <div class="col-sm-6">
					      <input type="tel" class="form-control" name="doctor_mobile" id="doctor_mobile" placeholder="Enter Mobile number" required value="<?php echo $header->doctor_mobile; ?>">
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="doctor_secondery_contact" class="col-sm-2 control-label">Landline number</label>
					    <div class="col-sm-6">
					      <input type="tel" class="form-control" name="doctor_secondery_contact" id="doctor_secondery_contact" placeholder="Enter Landline number" value="<?php echo $header->doctor_secondery_contact; ?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="doctor_address" class="col-sm-2 control-label">Street Address</label>
					    <div class="col-sm-6">
					    	
					    	<textarea class="form-control" name="doctor_address" id="doctor_address" placeholder="Enter Address" required ><?php echo $header->doctor_address; ?></textarea>
					      <script>
													                // Replace the <textarea id="editor1"> with a CKEditor
													                // instance, using default configuration.
													                CKEDITOR.replace( 'doctor_address' );
													            </script>
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="doctor_email" class="col-sm-2 control-label">E-Mail</label>
					    <div class="col-sm-6">
					      <input type="email" class="form-control" name="doctor_email" id="doctor_email" placeholder="Enter E-Mail" required value="<?php echo $header->doctor_email; ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="button" id="update_doc_record" class="btn btn-default"  name="update_doc_record" value = "Update">
					    </div>
					  </div>
					  <input type='hidden' name='mode' value="UPDATE">
					</form>
                   <!--END of form-->
                   <div class="alert alert-info" role="alert" id="update_doc_form_result" hidden="true">
				        
				   </div>
			  </div>
			  <h3 class="bg-success">My Chambers</h3>
			  <div class="row">
			  <div class="col-md-6">
			  	<h4>Chambers owned by me</h4>
			    <?php $result = $admin->getListOfChambersbyOwners($doc_name); ?>
			    <table class="table table-striped">
			    	<thead>
			    	<tr>
			    	<th>Chamber Name</th>
			    	<th>Chamber Address</th>
			    	<th>Action</th>
			    	</tr>
			    	</thead>
					<tbody>
 <?php while ($row = mysql_fetch_array($result)) {
 		echo "<tr>";
 		echo "<td>".$row['chamber_name']."</td>";
 		echo "<td>".$row['chamber_address']."</td>";
 		echo "<td><a  href='./makeprescription/create_chamber.php?mode=UPDATE&input_chamber_id=".$row['chamber_id']."'>Edit</a></td>";
 		echo "</tr>";
} 
?>
</tbody>
</table>
			  </div></div>
			  <h3 class="bg-info">My Receptionists</h3>
			  <div>
			    <p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. </p>
			    <ul>
			      <li>List item one</li>
			      <li>List item two</li>
			      <li>List item three</li>
			    </ul>
			  </div>
			  <h3 class="bg-warning">My Referred Doctors</h3>
			  <div>
			    <p>Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia mauris vel est. </p><p>Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
			  </div>
			</div>
        </div>
      </div>
    </div>
    
    <div id="dialog-form-edit-chamber" title="Create new user">
	  <p class="validateTips">All form fields are required.</p>
	 
	  <form>
	    <fieldset>
	      <label for="name">Name</label>
	      <input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
	      <label for="email">Email</label>
	      <input type="text" name="email" id="email" value="jane@smith.com" class="text ui-widget-content ui-corner-all">
	      <label for="password">Password</label>
	      <input type="password" name="password" id="password" value="xxxxxxx" class="text ui-widget-content ui-corner-all">
	 
	      <!-- Allow form submission with keyboard without duplicating the dialog button -->
	      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	    </fieldset>
	  </form>
	</div>
<?php } else { echo "You are not authorize to perform this operation";}?>

   <?php include_once './inc/footer.php';?>
  </body>
</html>