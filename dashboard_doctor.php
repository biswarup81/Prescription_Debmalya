<?php include_once "./inc/datacon.php";
include_once "./inc/header.php"; ?>

    <?php include './inc/dashboard_topnav.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <?php include './inc/dashboard_sidenav.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </div>

          
          <div class="row">
        		<div class="col-md-6">
        		<h2 class="sub-header">Day Wise Visit report</h2>
        		<table id="visit_list_table" class="table table-bordered">
		              <thead>
							<tr>
								<th>Total Visit</th>
								
								<th>Day</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Total Visit</th>
								
								<th>Day</th>
							</tr>
						</tfoot>
		              </tbody>
            	</table>
        		</div>
        		<div class="col-md-6">
        		<h2 class="sub-header">Month Wise Visit report</h2>
        		<table id="visit_list_table_monthly" class="table table-bordered">
		              <thead>
							<tr>
								<th>Total Visit</th>
								
								<th>Month</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Total Visit</th>
								
								<th>Month</th>
							</tr>
						</tfoot>
		              </tbody>
            	</table>
        		</div>
          </div>
          <div class="row">
          <div class="col-md-12">
        		<h2 class="sub-header">Comprehensive Visit report</h2>
        		
        		<table id="visit_list_all" class="table table-striped">
		              <thead>
							<tr>
								<th>Visit ID</th>
								
								<th>Patient ID</th>
								<th>Visited</th>
								<th>First Name</th>
								
								<th>Last Name</th>
								<th>Mobile</th>
								
								<th>Visit date</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Visit ID</th>
								
								<th>Patient ID</th>
								<th>Visited</th>
								<th>First Name</th>
								
								<th>Last Name</th>
								<th>Mobile</th>
								
								<th>Visit date</th>
							</tr>
						</tfoot>
		              </tbody>
            	</table>
        		</div>
          </div>
          
            
          
        </div>
      </div>
    </div>

   <?php include_once './inc/footer.php';?>
  </body>
</html>
