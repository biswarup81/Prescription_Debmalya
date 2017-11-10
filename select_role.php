<?php include "./inc/datacon.php"; 
include_once './inc/header.php';?>

<body>



<div class="container theme-showcase" role="main">
	          	<div class="page-header">
			        <h1>Select User Role</h1>
			    </div>
	          	<div class="dropdown">
				  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Role (For Registration)
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu">
		          
		          	<li><a href='signup.php?role=DOCTOR'>Sign-up as Doctor</a></li> 
		          	<li><a href='signup.php?role=CHEMIST'>Sign-up as Chemist/Pharmasist</a></li> 
		          	<li><a href='signup.php?role=USER'>Sign-up as Doctor</a></li> 
		          </ul>
				</div>
	          	
          
	  
</div>


<?php 
include_once './inc/footer.php';
 ?>

</body>
</html>