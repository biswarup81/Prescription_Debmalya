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

</script>

<?php 

if(isset($_SESSION['user_type']) &&isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])) {
if($_SESSION['user_type'] == 'DOCTOR' || $_SESSION['user_type'] == 'RECEPTIONIST'){
   $patientId = $_GET['patient_id'];
   $chamber_name = $_SESSION['chamber_name'];
   $doc_name= $_SESSION['doc_name'];
   $admin = new admin();
   
?>
    <body>
	<div class="container">
            <?php include("banner.php"); ?>
                
            
                   <h2>Edit Patient Record</h2>
                    <div class="row">
                    <?php 
                    $patientObj = $admin->getPatientDetailsPatientId($patientId, $chamber_name, $doc_name);
                    ?>
                    <form id="update_rec_form" class="form-horizontal" >
                    <input type="hidden" name="chamber_id" value="<?php echo $_SESSION['chamber_name']; ?>">
                    <input type="hidden" name="patientId" value="<?php echo $patientId ?>"/>
                        <input type="hidden" name="doc_id" value="<?php echo $_SESSION['doc_name']; ?>">
                            <input type="hidden" name="loged_in_user_id" value="<?php echo $_SESSION['user_name']; ?>">
                                <div class="alert alert-danger" role="alert" id="search_alert_2" hidden="true">
                                
                                </div>
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Gender</label>
                                <div class="col-sm-2">
                                <select class="form-control" name="gender" id="gender">
                                <?php if($patientObj->GENDER == 'Female'){ ?><option value="Female" selected>Female</option><option value="Male">Male</option>
                                <option value="Transgender">Transgender</option> <?php } else if ($patientObj->GENDER == 'Male') {?><option value="Female">Female</option><option value="Male" selected>Male</option>
                                <option value="Transgender">Transgender</option><?php }else if ($patientObj->GENDER == 'Transgender') {?><option value="Female">Female</option><option value="Male">Male</option>
                                <option value="Transgender" selected>Transgender</option><?php } ?> 
                                
                                </select>
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="fname" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $patientObj->patient_first_name; ?>" >
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="lname" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $patientObj->patient_last_name; ?>" >
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="theDate" class="col-sm-2 control-label">Date of Birth</label>
                                <div class="col-sm-2">
                                <input type="date" class="form-control" name="theDate" id="theDate" value="<?php echo $patientObj->patient_dob; ?>">
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="cellnum" class="col-sm-2 control-label">Mobile number</label>
                                <div class="col-sm-6">
                                <input type="tel" class="form-control" name="cellnum" id="cellnum" value="<?php echo $patientObj->patient_cell_num; ?>">
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="altcellnum" class="col-sm-2 control-label">Landline number</label>
                                <div class="col-sm-6">
                                <input type="tel" class="form-control" name="altcellnum" value="<?php echo $patientObj->patient_alt_cell_num; ?>" >
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="lname" class="col-sm-2 control-label">Street Address</label>
                                <div class="col-sm-6">
                                
                                <textarea class="form-control" name="addr" ><?php echo $patientObj->patient_address; ?></textarea>
                                
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="lname" class="col-sm-2 control-label">City/Town</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" name="city" value="<?php echo $patientObj->patient_city; ?>" >
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="lname" class="col-sm-2 control-label">E-Mail</label>
                                <div class="col-sm-6">
                                <input type="email" class="form-control" name="email" value="<?php echo $patientObj->patient_email; ?>" >
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <input type="button" id="modify_patient_record" class="btn btn-default"  value="MODIFY" name="MODIFY" >
                                </div>
                                </div>
                                </form>
        </div>
        <!--BEGIN footer-->
    <!--BEGIN footer-->
                <?php include "footer_pg.php"; ?> 
                <!--END of footer-->
                </div><!-- End container -->

        
    <?php include_once './inc/footer.php';?>
</body>
<?php } 
}else {
echo "You are not authorize to view this page";
}?>
</html>