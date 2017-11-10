<?php include "./inc/datacon.php"; ?>

<?php 
$_SESSION['NAVIGATION'] = 'visit_list';
?>

<body>

<?php 


if( isset($_SESSION['user_type'])  && isset($_GET['chamber_name']) || (isset($_SESSION['user_type']) && isset($_SESSION['chamber_name']))){
	if($_SESSION['user_type'] == "RECEPTIONIST") {
		if(isset($_GET['chamber_name'])){
			$_SESSION['chamber_name'] = $_GET['chamber_name'];
		}
		$chamber_id = $_SESSION['chamber_name'];
		include_once './inc/header.php';
		$user_name = $_SESSION['user_name']  ;
		$user_type = $_SESSION['user_type']  ;
		$user_id = $_SESSION['user_id'];
		
		?>

<div class="container theme-showcase" role="main">
	<div class="page-header">
        <h1>Select Doctor</h1>
    </div>
    <?php 
	    include_once 'classes/admin_class.php';
	    
        ?>  
    
    <div class="dropdown">
	  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Doctor
	  <span class="caret"></span></button>
	  <ul class="dropdown-menu">
	     <?php 
          
	     $_QUERY= "select a.doctor_full_name, b.related_doc_name from doctor_master a, chamber_master b where a.doctor_id = b.related_doc_name and b.chamber_id='".$chamber_id."'";
	     //echo $_QUERY;
	     $result = mysql_query($_QUERY) or die(mysql_error()); 
	          	while($rows = mysql_fetch_array($result)) {
	          		echo "<li><a href='visit_list.php?doc_name=".$rows['related_doc_name']."'>". $rows['doctor_full_name']."</a></li>";
	          	} ?>
	  </ul>
	  
	</div>
</div>


<?php 

include_once './inc/footer.php';
	} else {echo "Your role is ".$_SESSION['user_type']."You are not authorize to open this page. Please login again";}
	
} else {
    /* header("location:index_login.php"); */
    echo "<script>location.href='index_login.php'</script>";
} ?>

</body>
</html>