<?php include_once "./inc/datacon.php";
include_once "./inc/header.php";
include_once "classes/admin_class.php";
?> 
<script type="text/javascript">
   function myFocus(element) {
     if (element.value == element.defaultValue) {
       element.value = '';
     }
   }
   function myBlur(element) {
     if (element.value == '') {
       element.value = element.defaultValue;
     }
   }
   function check(){
	if(document.form1.fname.value == ""){
		alert("Please Insert First Name.");
		return false;
	}else if(document.form1.lname.value == ""){
		alert("Please Insert Last Name Name.");
		return false;
	}else if(document.form1.cellnum.value == ""){
		alert("Please Insert Mobile Number.");
		return false;
	}else{
		return true;
	}
    }
    function checkSearch(){
	if(document.s_form.patient_id.value == "" && document.s_form.patient_name.value == ""){
		alert("Please Give some Input");
		return false;
	}
    }
    function search1(){
        //alert(document.getElementById("s_p_id").value);
        //alert(document.getElementById("s_p_name").value);
        if(document.getElementById("s_p_id").value == "" && document.getElementById("s_p_name").value == ""){
		alert("Please Give some Input");
		return false;
	} else {
            var patient_id = document.getElementById("s_p_id").value;
            var patient_name = document.getElementById("s_p_name").value;
            
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

                    xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("searchDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/searchPatient.php?mode=SEARCH_PATIENT&patient_id="+patient_id+"&patient_name="+patient_name;   
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
        }
        
    }
</script>
    
<body>
    
<!--BEGIN wrapper-->
<?php 
if(isset($_SESSION['user_type']) &&isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])) {
/*if($_SESSION['user_type'] == 'DOCTOR'){
    header("location:visit_list.php");
} else if($_SESSION['user_type'] == 'RECEPTIONIST'){*/
?>

	<div class="container">
    <!--BEGIN header-->
    <?php include("banner.php"); ?>
    <!--END of header-->
    
    <!--BEGIN details-->
    <div class="invest">    
    	<div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Patient Details</div>
        <div class="div_visit_list">     
        
        	<div id="tabs" >
        		 <ul class="tabnav">
                    <li><a href="#tab2">Search Patient</a></li>
					<li><a href="#tab1">Add New Patient</a></li>
                </ul>
        		 <!--BEGIN tab2-->
                <div id="tab2" class="tabdiv">
                	
                    
                    <form class="form-horizontal">
                      <div class="alert alert-danger" role="alert" id="search_alert" hidden="true">
				        
				      </div>
					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label">Patient ID</label>
					    <div class="col-sm-2">
					      <input type="number" class="form-control" id="s_p_id" name="patient_id" placeholder="Patient ID">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label">Patient Name</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" id="s_p_name" name="patient_name" placeholder="Patient name">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="button" id="search" class="btn btn-default"  value="Search" name="search" >
					    </div>
					  </div>
					</form>
                    
                    
                    <!--BEGIN search results-->
                    <div id="searchDiv">
                    
                        <!--RESULT OF SEARCH -->

                    
                    </div>
                    <!--END of results-->
                    
                </div>
                <!--END of tab2-->
                <!--BEGIN tab1-->
                <div id="tab1" class="tabdiv">
                    
                   <!-- If Doctor-->
                   <?php if($_SESSION['user_type'] == 'DOCTOR'){ ?>
                   <!--BEGIN form-->
                   <form id="doc_create_form" class="form-horizontal" >
                   <input type="hidden" name="chamber_id" value="<?php echo $_SESSION['chamber_name']; ?>">
				      <input type="hidden" name="doc_id" value="<?php echo $_SESSION['doc_name']; ?>">
				      <input type="hidden" name="loged_in_user_id" value="<?php echo $_SESSION['user_name']; ?>">
                      <div class="alert alert-danger" role="alert" id="search_alert_1" hidden="true">
				        
				      </div>
					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
					    <div class="col-sm-2">
					      <select class="form-control" name="sex" id="sex">
                            <option value="0">--SELECT--</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Transgender">Transgender</option>
                        </select>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="patient_name" class="col-sm-2 control-label">Patient Name</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" id="patient_name" name="patient_name" placeholder="Enter Name">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="theDate" class="col-sm-2 control-label">Date of Birth</label>
					    <div class="col-sm-2">
					      <input type="date" class="form-control" name="theDate" id="theDate" placeholder="DOB">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="cell" class="col-sm-2 control-label">Phone number</label>
					    <div class="col-sm-6">
					      <input type="tel" class="form-control" name="cell" id="cell" placeholder="Mobile number">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="button" id="add" class="btn btn-default"  value="ADD" name="ADD" >
					    </div>
					  </div>
					</form>
                   <!--END of form-->
                   <div class="alert alert-info" role="alert" id="create_result" hidden="true">
				        
				   </div>
                   
                   
                    
                    <?php }  else if($_SESSION['user_type'] == 'RECEPTIONIST'){?>
                    
                      
                    
                    
                    <form id="create_rec_form" class="form-horizontal" >
                    <input type="hidden" name="chamber_id" value="<?php echo $_SESSION['chamber_name']; ?>">
				      <input type="hidden" name="doc_id" value="<?php echo $_SESSION['doc_name']; ?>">
				      <input type="hidden" name="loged_in_user_id" value="<?php echo $_SESSION['user_name']; ?>">
                      <div class="alert alert-danger" role="alert" id="search_alert_2" hidden="true">
				        
				      </div>
					  <div class="form-group">
					    <label class="col-sm-2 control-label">Gender</label>
					    <div class="col-sm-2">
					      <select class="form-control" name="gender" id="gender">
                            <option value="0">--SELECT--</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Transgender">Transgender</option>
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
					    <label for="theDate" class="col-sm-2 control-label">Date of Birth</label>
					    <div class="col-sm-2">
					      <input type="date" class="form-control" name="theDate" id="theDate" placeholder="Enter Date of Birth">
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
					    	<input type="button" id="add_by_recption" class="btn btn-default"  value="ADD" name="ADD" >
					    </div>
					  </div>
					</form>
                   <!--END of form-->
                   <div class="alert alert-info" role="alert" id="create_r_result" hidden="true">
				        
				   </div>
                    
                   
                   <?php } ?>
                </div>
                <!--END of tab1-->
                <div class="clearfix">..</div>
                <div align="center"><a href="visit_list.php">Click Here to go to VISIT LIST</a></div>
        	</div>   
        
           
        </div>
    
    </div>
    <!--END of details-->
    
   <?php include "footer_pg.php"; ?>
    
	</div><!-- End container-->

<?php } /*}*/ else {
    /*  header("location:index_login.php"); */
    echo "<script>location.href='index_login.php'</script>";
}
include_once './inc/footer.php';
?>
</body>
</html>
<?php ob_flush() ?>