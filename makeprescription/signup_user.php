<form id="create_user_form" class="form-horizontal" >
<input type="hidden" name="role" id="role" value="<?php echo $role;?>"  >
			<div class="alert alert-danger" role="alert" id="search_alert_u" hidden="true">
			
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Gender</label>
			<div class="col-sm-2">
			<select class="form-control" name="gender" id="gender">
			<option value="0">--SELECT--</option>
			<option value="Female">Female</option>
			<option value="Male">Male</option>
			<option value="Trans">Transgender</option>
			</select>
			</div>
			</div>
			<div class="form-group">
			<label for="fname" class="col-sm-2 control-label">First Name</label>
			<div class="col-sm-6">
			<input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name">
			</div>
			</div>
			<div class="form-group">
			<label for="lname" class="col-sm-2 control-label">Last Name</label>
			<div class="col-sm-6">
			<input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name">
			</div>
			</div>
			<div class="form-group">
			<label for="uid" class="col-sm-2 control-label">User Id</label>
			<div class="col-sm-4">
			<input type="text" class="form-control" name="uid" id="uid" placeholder="Enter userid">
			</div>
			</div>
			<div class="form-group">
			<label for="password" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-3">
			<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
			</div>
			</div>
			<div class="form-group">
			<label for="theDate" class="col-sm-2 control-label">Date of Birth</label>
			<div class="col-sm-2">
			<input type="text" class="form-control" name="theDate" id="theDate" placeholder="Enter Date of Birth">
			</div>
			</div>
			<div class="form-group">
			<label for="cellnum" class="col-sm-2 control-label">Mobile number</label>
			<div class="col-sm-6">
			<input type="tel" class="form-control" name="cellnum" id="cellnum" placeholder="Enter Mobile number">
			</div>
			</div>
			<div class="form-group">
			<label for="altcellnum" class="col-sm-2 control-label">Landline number</label>
			<div class="col-sm-6">
			<input type="tel" class="form-control" name="altcellnum" placeholder="Enter Landline number">
			</div>
			</div>
			<div class="form-group">
			<label for="lname" class="col-sm-2 control-label">Street Address</label>
			<div class="col-sm-6">
			
			<textarea class="form-control" name="addr" placeholder="Enter Address"></textarea>
			
			</div>
			</div>
			<div class="form-group">
			<label for="lname" class="col-sm-2 control-label">City/Town</label>
			<div class="col-sm-6">
			<input type="text" class="form-control" name="city" placeholder="Enter City/Town">
			</div>
			</div>
			<div class="form-group">
			<label for="lname" class="col-sm-2 control-label">E-Mail</label>
			<div class="col-sm-6">
			<input type="email" class="form-control" name="email" placeholder="Enter E-Mail">
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			<input type="button" id="add_by_user" class="btn btn-default"  value="ADD" name="ADD" >
			</div>
			</div>
			</form>
			<!--END of form-->
			<div class="alert alert-info" role="alert" id="create_u_result" hidden="true">
			
			</div>