<?php include_once "./inc/datacon.php";
include_once "./inc/header.php"; 

if(isset($_SESSION['user_type']) ){
	if(isset($_SESSION['user_name'])  && $_SESSION['user_type'] == "DOCTOR") { 
		//include './classes/admin_class.php';
	$doc_name= $_SESSION['user_name'];
	
?>
<h1>Chamber registration</h1>
<div id="tabs" >
	 <ul class="tabnav">
		<li><a href="#tab1">Associate Chamber</a></li>
		<li><a href="#tab2">Add new Chamber</a></li>
	</ul>
	 <!--BEGIN tab2-->
	<div id="tab1" class="tabdiv"></div>
	<div id="tab2" class="tabdiv">
	<form id="create_chamber_form" class="form-horizontal" >
		<input type="hidden" name = "related_doc_name" value="$user_name">
		  <div class="alert alert-danger" role="alert" id="add_chamber_alert_2" hidden="true">
			
		  </div>
		 
		  <div class="form-group">
			<label for="chamber_name" class="col-sm-2 control-label">Chamber Name</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" name="chamber_name" id="chamber_name" placeholder="Enter chamber name" required >
			</div>
		  </div>
		 <div class="form-group">
			<label for="chamber_id" class="col-sm-2 control-label">Chamber ID</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" name="chamber_id" id="chamber_id" placeholder="chamber Id (short name)" required>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="chamber_footer" class="col-sm-2 control-label">Chamber Footer</label>
			<div class="col-sm-6">
			  <textarea class="form-control" rows="3" name="chamber_footer" id="chamber_footer" placeholder="Enter footer information" required></textarea>
			</div>
		  </div>
		   <div class="form-group">
			<label for="chamber_header" class="col-sm-2 control-label">Chamber Header</label>
			<div class="col-sm-6">
			  <textarea class="form-control" rows="3" name="chamber_header" id="chamber_header" placeholder="Enter header information" ></textarea>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="primary_phone_number" class="col-sm-2 control-label">Mobile number</label>
			<div class="col-sm-6">
			  <input type="tel" class="form-control" name="primary_phone_number" id="primary_phone_number" placeholder="Enter Mobile number" required>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="secondary_phone_number" class="col-sm-2 control-label">Landline number</label>
			<div class="col-sm-6">
			  <input type="tel" class="form-control" name="secondary_phone_number" id="secondary_phone_number" placeholder="Enter Landline number" >
			</div>
		  </div>
		  <div class="form-group">
			<label for="chamber_address" class="col-sm-2 control-label">Chamber Address</label>
			<div class="col-sm-6">
				
				<textarea class="form-control" name="chamber_address" id="chamber_address" placeholder="Enter Address" required></textarea>
			  
			</div>
		  </div>
		  
		  
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button id="add_chamber" class="btn btn-default"  name="add_chamber" >Add Chamber</button>
			</div>
		  </div>
		</form>
	   <!--END of form-->
	   <div class="alert alert-info" role="alert" id="add_chamber_form_result" hidden="true">
			
	   </div>
	</div>
</div>
<?php 
	} else if($_SESSION['user_type'] == "CHEMIST" ){ ?>
		<h1>Chamber registration</h1>
<div id="tabs" >
	 <ul class="tabnav">
		<li><a href="#tab1">Associate Chamber</a></li>
		<li><a href="#tab2">Add new Chamber</a></li>
	</ul>
	 <!--BEGIN tab2-->
	<div id="tab1" class="tabdiv"></div>
	<div id="tab2" class="tabdiv">
	<form id="create_chamber_form" class="form-horizontal" >
		
		  <div class="alert alert-danger" role="alert" id="add_chamber_alert_2" hidden="true">
			
		  </div>
		 
		  <div class="form-group">
			<label for="chamber_name" class="col-sm-2 control-label">Chamber Name</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" name="chamber_name" id="chamber_name" placeholder="Enter chamber name" required >
			</div>
		  </div>
		 <div class="form-group">
			<label for="chamber_id" class="col-sm-2 control-label">Chamber ID</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" name="chamber_id" id="chamber_id" placeholder="chamber Id (short name)" required>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="chamber_footer" class="col-sm-2 control-label">Chamber Footer</label>
			<div class="col-sm-6">
			  <textarea class="form-control" rows="3" name="chamber_footer" id="chamber_footer" placeholder="Enter footer information" required></textarea>
			</div>
		  </div>
		   <div class="form-group">
			<label for="chamber_header" class="col-sm-2 control-label">Chamber Header</label>
			<div class="col-sm-6">
			  <textarea class="form-control" rows="3" name="chamber_header" id="chamber_header" placeholder="Enter header information" ></textarea>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="primary_phone_number" class="col-sm-2 control-label">Mobile number</label>
			<div class="col-sm-6">
			  <input type="tel" class="form-control" name="primary_phone_number" id="primary_phone_number" placeholder="Enter Mobile number" required>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="secondary_phone_number" class="col-sm-2 control-label">Landline number</label>
			<div class="col-sm-6">
			  <input type="tel" class="form-control" name="secondary_phone_number" id="secondary_phone_number" placeholder="Enter Landline number" >
			</div>
		  </div>
		  <div class="form-group">
			<label for="chamber_address" class="col-sm-2 control-label">Chamber Address</label>
			<div class="col-sm-6">
				
				<textarea class="form-control" name="chamber_address" id="chamber_address" placeholder="Enter Address" required></textarea>
			  
			</div>
		  </div>
		  
		  
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button id="add_chamber" class="btn btn-default"  name="add_chamber" >Add Chamber</button>
			</div>
		  </div>
		</form>
	   <!--END of form-->
	   <div class="alert alert-info" role="alert" id="add_chamber_form_result" hidden="true">
			
	   </div>
	</div>
</div>
	<?php }
}else { echo "Youa re not authorize to use do any operation"; }?>