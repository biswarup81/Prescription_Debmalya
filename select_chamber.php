<?php include "./inc/datacon.php"; ?>

<body>

<?php 
if(isset($_SESSION['user_type'])) {
	include_once './inc/header.php';
    $user_name = $_SESSION['user_name']  ;
    $user_type = $_SESSION['user_type']  ;
    $user_id = $_SESSION['user_id'];
    
    

?>

<div class="container theme-showcase" role="main">
	
    <?php 
	    include_once 'classes/admin_class.php';
	    $adminObj = new admin();
	    $resultObj = $adminObj->getUserDetails($user_id);
    	
          
        
        ?>  
    
    
	     <?php 
          if($user_type == 'DOCTOR' ){ 
          	
              $_QUERY= "select * from chamber_master where related_doc_name='".$user_id."'";
          	$result = mysql_query($_QUERY) or die(mysql_error()); 
	          	if(mysql_num_rows($result)>0){ ?>
	          	<div class="page-header">
			        <h1>Select Chamber Name</h1>
			    </div>
	          	<div class="dropdown">
				  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Chamber
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu">
		          <?php while($rows = mysql_fetch_array($result)) {
		          	echo "<li><a href='visit_list.php?chamber_name=".$rows['chamber_id']."&doc_name=".$user_name."'>". $rows['chamber_name']."</a></li>";  
		          } ?>
		          </ul>
				</div>
	          	<?php } else { 
	          	    
	          		 include("makeprescription/create_chamber.php");
	          	 } ?>
	          	
          <?php } else if ($user_type == 'RECEPTIONIST'){
          	$_QUERY= "select * from chamber_master where related_rec_name='".$user_name."'";
          	$result = mysql_query($_QUERY) or die(mysql_error()); 
          	if(mysql_num_rows($result)>0){ ?>
          	<div class="page-header">
			        <h1>Select Chamber Name</h1>
			    </div>
          	<div class="dropdown">
				  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Chamber
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu">
	        <?php   	while($rows = mysql_fetch_array($result)) {
	          		echo "<li><a href='select_doctor.php?chamber_name=".$rows['chamber_id']."'>". $rows['chamber_name']."</a></li>";
	          	} ?>
	          	 </ul>
				</div>
          	<?php } else {
          		echo "<p>You are not associated with any of the doctor. Kindly contact your doctor.";
          	}
          } else if($user_type == 'CHEMIST' ){
          	
          	$_QUERY= "select a.chamber_id, a.chamber_name from chamber_master a, chamber_owner b where b.owner_id='".$user_name."' and a.chamber_id=b.chamber_id";
          	$result = mysql_query($_QUERY) or die(mysql_error());
	          	if(mysql_num_rows($result)>0){ ?>
	          	<div class="page-header">
			        <h1>Select Chamber Name</h1>
			    </div>
	          	<div class="dropdown">
				  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Chamber
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu">
		          <?php while($rows = mysql_fetch_array($result)) {
		          	echo "<li><a href='select_doctor.php?chamber_name=".$rows['chamber_id']."'>". $rows['chamber_name']."</a></li>";  
		          } ?>
		          </ul>
				</div>
	          	<?php } else { 
	          		 include("makeprescription/create_chamber.php");
	          	 } ?>
	          	
          <?php } ?>
	  
</div>


<?php 
include_once './inc/footer.php';
} else {
    /* header("location:index_login.php"); */
    echo "<script>location.href='index_login.php'</script>";
} ?>

</body>
</html>