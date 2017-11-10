<?php include_once "./inc/datacon.php";
include_once 'classes/admin_class.php';
if(isset($_SESSION['user_type']) && isset($_SESSION['user_id']) && (isset($_GET['chamber_name']) ||   isset($_SESSION['chamber_name'])) && (isset($_GET['doc_name']) ||   isset($_SESSION['doc_name']))) {
    $user_id = $_SESSION['user_id'];
    $adminObj = new admin();
    $resultObj = $adminObj->getUserDetails($user_id);
    $user_type = $_SESSION['user_type'];
    
    

?>
<!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!--  <a class="navbar-brand" href="#">Welcome back <?php echo $resultObj->user_full_name; ?></a> -->
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="visit_list.php">Visit List</a></li>
              <li><a href="master.php">Master Data Management</a></li>
              <li><a href="reports.php">Reports</a></li>
              <?php if($user_type == "DOCTOR"){ ?>
    	<li><a href="dashboard_doctor.php">My dashboard</a></li>
	    <?php } else if($user_type == "RECEPTIONIST"){ ?>
	    	<li><a href="dashboard_receptionist.php">My dashboard</a></li>
		<?php }?>
             
            </ul>
            <ul class="nav navbar-nav navbar-right">
              
              <li class="active"><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
<?php }?>