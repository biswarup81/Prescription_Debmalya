<?php if(isset($_SESSION['chamber_name']) && isset($_SESSION['user_id']) && isset($_SESSION['visit_date'])) {
	include_once "./inc/datacon.php";
	include_once "classes/admin_class.php" ;
	$chamber_id = $_SESSION['chamber_name'];
	$user_id = $_SESSION['chamber_name'];
	
	$admin_obj = new admin();
	
	$obj = $admin_obj->getChamberDetails($chamber_id);
	$objDoc = $admin_obj->getDoctorDetails($user_id);
	//fetch the header information
	$docname = $objDoc->doctor_full_name;
	$reg_num = $objDoc->doc_reg_num;
	$footer = $obj->chamber_footer;
	$visit_date = $_SESSION['visit_date'];
	
	?>
	
<div class="invest">
        <div class="col-md-8-print"> Date : <?php echo $visit_date; ?></div>
        <div class="col-md-4-print" align="right"><b>(<?php echo $docname; ?>) </b><br>Reg. No. # <?php echo $reg_num; ?></div>
</div>	
<div class="invest">
      
      <div class="alert alert-info" role="alert">
        <strong><?php echo $footer;?></strong>
      </div>
      
     
</div>
<?php }?>