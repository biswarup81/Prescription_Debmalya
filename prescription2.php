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

</head>

<?php



if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
if(isset($_SESSION['NAVIGATION'])){
if( $_SESSION['NAVIGATION'] == 'visit_list'){
    
    if(isset($_GET['VISIT_ID'])  && isset($_GET['patient_id']) && isset($_GET['PRESCRIPTION_ID']) ) {
    
$user_type = $_SESSION['user_type'] ;
//echo "user_type ==>".$user_type;
$patient_id = $_GET['patient_id'];
$visit_id = $_GET['VISIT_ID'];


$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$_SESSION['PRESCRIPTION_ID'] = $PRESCRIPTION_ID;
$_SESSION['VISIT_ID'] = $visit_id;


?>

<body >
    
   
<?php


//$r1 = mysql_query("select * from patient where patient_id = '$patient_id'") or die(mysql_error());

$update= new admin(); 
$d1 = $update->getPatientInformationForPrescription($patient_id, $chamber_name, $doc_name);
//$r2 = mysql_query("select * from visit where PATIENT_ID = '$patient_id'");
//$n2 = mysql_num_rows($r2);
?>

            <!-- Begin container -->
<div class="container">
        
            <!--BEGIN header-->
            <?php include("banner.php") ?>
            
            <!--END of header-->
            <div class="row">
            <!--START of patient details-->        
                    <div class="inner_name" >
                        
                        #  <?php echo $d1->patient_id; ?>, <?php if($d1->patient_name == null || $d1->patient_name == ""){
                            echo $d1->patient_first_name." ".$d1->patient_last_name; } else { echo $d1->patient_name ; }?>, <?php echo $d1->GENDER ?>, <?php 
                        
                        if($d1->age == 0){
                            print $update->calcAge1($d1->patient_dob, $d1->VISIT_DATE) ;
                        }else {
                            echo $d1->age;
                        } ?>
					(<?php echo $d1->patient_address . ", " . $d1->patient_city; ?>, Ph: <?php echo $d1->patient_cell_num; ?>)
                    </div>
             </div>       
           
            <!--END of patient details-->
            
            <form id="form1" name="form1" method="post" action="printprescription.php" onsubmit="return validate();" >
           
           <?php if($doc_name == "hindol"){?>
           		<div class="row">
            
                <!--BEGIN block one-->
                <?php /* include("makeprescription/clinical_impression.php"); */?>
                <div class="col-md-3"><?php include("makeprescription/symptoms.php"); ?></div>
                
                <!--END of block one-->

				<!--BEGIN block two-->
                <?php /* include("makeprescription/investigation_done.php"); */?>
                <div class="col-md-3"><?php include("makeprescription/past_medical_history.php"); ?></div>

                <!--END of block two-->

				 <!--BEGIN block three-->
                <div class="col-md-3"><?php include("makeprescription/social_history.php");?></div>
                
                
              <!--END of block three-->
               <!--BEGIN block FOUR-->
              <div class="col-md-3"><?php include("makeprescription/addiction_hindol.php");?></div>
               
              <!--END of block FOUR-->
            </div>
            <div class="row">
               
              <!--BEGIN block FOUR-->
              <div class="col-md-3"><?php include("makeprescription/allergy.php"); ?></div>
               
              <!--END of block FOUR-->
              
			    

				<!--BEGIN block two-->
                <div class="col-md-3"><?php include("makeprescription/investigation_done.php");?></div>
                
                <!--END of block two-->

				 <!--BEGIN block three-->
                <div class="col-md-3"><?php include("makeprescription/c_f.php");?></div>
                
                
              <!--END of block three-->
               <!--BEGIN block FOUR-->
              <div class="col-md-3"><?php include("makeprescription/lmp.php"); ?></div>
                
              <!--END of block FOUR-->

            
            </div>
           <?php } else {?>
            <div class="row">
              <div class="col-md-3"><?php include("makeprescription/clinical_impression.php");?></div>
              
              
              <div class="col-md-3"><?php include("makeprescription/investigation_done.php");?></div>
              <div class="col-md-3"><?php include("makeprescription/c_f.php");?></div>
              <div class="col-md-3"><?php include("makeprescription/addiction.php");?></div>
              
            </div>
            <?php }?>
            
            <!--BEGIN doctor comment/advice section-->
            <div class="diet" style="margin-top: 5px;">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Comment / Advice</div>
                <textarea class="form-control"  name="other_comment" rows="3"></textarea>
            
            </div>
            <!--END doctor comment/advice section-->
            
            <!--BEGIN diet section-->
            <div class="diet" >    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Diet & Lifestyle Recommendation</div>
                <textarea class="form-control" name="diet" rows="3">Diet   Kcal/day, Cholesterol < 200 gm /day , Saturated Fat < 7%, Walking at recommended speed for atleast 30 mins/day, Alerted to hypoglycaemia (CBG < 70 mg/dl/SMBG)</textarea>       
                
            </div>
            
            <!-- END diet section-->
            
           
              
                <div class="headings" ><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Rx (Prescription)</div>
                      
                    
                    <?php
                        
                    //Retrieve last prescription id
                    //$q11 = "select * from precribed_medicine where PRESCRIPTION_ID = '".$lastPrescription."'"; 
                    //echo $q11;
                    $q11 = "SELECT * FROM precribed_medicine a WHERE PRESCRIPTION_ID = '".$PRESCRIPTION_ID."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
                            //echo $q5;
                    
                            $result = mysql_query($q11) or die(mysql_error()); 
                    ?>
                   
                    <div  id="medicine" >
                       
                        <table id="table-3" class="table"> 
                        <?php while($rs = mysql_fetch_array($result)) { ?>

                            <tr>
                                <td>
                                    <img src="images/stock_list_bullet.png"/>&nbsp<strong><?php echo $rs['MEDICINE_NAME'] ?></strong>
                                    <input type="hidden" class="input_box" name="medicine_name" value="<?php echo $rs['MEDICINE_NAME'];?>"/>
                                    <img src="images/arrow-right.png" />
                                        <i><?php echo $rs['MEDICINE_DOSE'] ?></i><input type="hidden" class="input_box_small" name="dose" value="<?php echo $rs['MEDICINE_DOSE'];?>" /></td>
                                <td  align="center" width="90"    >
									<input id="remove_<?php echo $rs['MEDICINE_ID'] ?>" class="btn btn-warning" type="button" value="Remove" onclick="del('<?php echo $rs['MEDICINE_ID'] ?>','<?php echo $PRESCRIPTION_ID ?>');">
                                    
                                </td>

                            </tr>

                        <?php } ?>
                        </table>
                    </div>
                    
                    <div class="row">
						<div class="col-md-4">Medicine Names</div>
						<div class="col-md-1">Breakfast</div>
						<div class="col-md-1">Lunch</div>
						<div class="col-md-1">Dinner</div>
						<div class="col-md-1">Bedtime</div>
						<div class="col-md-2">Duration</div>
						<div class="col-md-2">Action</div>
					</div>
                    <div class="row">
						<div class="col-md-4"><input type="text" name="medicine_name" id="course" class="form-control" placeholder="Enter Medicine name" /></div>
						<div class="col-md-1"><input name="dose1" id="dose1" type="text"  class="form-control" placeholder="Breakfast"/><input type="radio" name="bfradio" value ="before"/> before <input type="radio" name="bfradio" value ="after"/> after</div>
						<div class="col-md-1"><input name="dose2" id="dose2" type="text" class="form-control" placeholder="Lunch"/><input type="radio" name="lradio" value ="before"/> before <input type="radio" name="lradio" value ="after"/> after</div>
						<div class="col-md-1"><input name="dose3" id="dose3" type="text" class="form-control" placeholder="Dinner"/><input type="radio" name="dradio" value ="before"/> before <input type="radio" name="dradio" value ="after"/> after</div>
						<div class="col-md-1"><input name="dose4" id="dose4" type="text" class="form-control" placeholder="Bedtime"/><input type="radio" name="bdradio" value ="before"/> before <input type="radio" name="bdradio" value ="after"/> after</div>
						
						<div class="col-md-2">
                               
                                        <input name="duration_count" id="duration_count" type="text" class="input_box_very_small"/>
                                        <select name="duration_type" id="duration_type">
                                                <option value="Days">Days</option>
                                                <option value="Weeks">Weeks</option>
                                                <option value="Months">Months</option>
                                            </select>
                                            
                                   
                            </div>
						
						<div class="col-md-2"><input type="hidden" name="PRESCRIPTION_ID" value="<?php echo $_GET['PRESCRIPTION_ID']; ?>" id="PRESCRIPTION_ID" />
						<input type="hidden" name="hidden_prescribed_medicine_id" value="" id="hidden_prescribed_medicine_id" />
								<input type="hidden" name="patient_id" value="<?php echo $_GET['patient_id']; ?>" id="patient_id" />
								<input type="hidden" name="VISIT_ID" value="<?php echo $_GET['VISIT_ID']; ?>" id="VISIT_ID" /><button class="btn btn-primary" id="add_medicine_for_prescription" >Add</button> </div>
					</div>
                                 
                
            
            
            <!--END of rx section-->
            
            
             
            
            <!--BEGIN Prescribed Investigation section-->
            
            <div class="invest" >    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Prescribed Investigation</div>
                <div id="tabs" ><?php include("makeprescription/invest.php");?></div>
                

            </div>
            
            <div class="diet">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Patient's Next Visit</div>
                <div class="row">        
                    <div class="col-md-1">After</div><div class="col-md-1"><input name="nextvisit" type="text" class="form-control" value="2" onfocus="myFocus(this);" onblur="myBlur(this);"/> </div><div class="col-md-8">Months/Weeks</div>
                
                </div>
            
            </div>
            
            
            
            <!--BEGIN submit button-->
            
            
                <div class="btn_wrap">
                    <?php if ($user_type == 'DOCTOR') {  ?>
                    <input type="submit" class="btn btn-primary" name="MAKE_PRESCIPTION" id="MAKE" value="MAKE PRESCIPTION" />
                     <?php } ?>
                    <input type="button" class="btn btn-default" name="BACK" id="MAKE" value="Back" onclick="backtoVisit()"/>
                </div>
                
            <!--END of submit button-->
            
           
            
            <!--END of diet section-->
            <!--END of rx special-->
            </form>
            <?php include "footer_pg.php"; 
			    
			    ?> 
            </div><!-- End container -->
        
     
        <?php }else {
            header("location:blank_prescription.php");
            echo "<script>location.href='blank_prescription.php'</script>";
        }
        
        }}else{ 
    /* header("location:visit_list.php"); */
            echo "<script>location.href='blank_prescription.php'</script>";
            
        }} else {
            echo "Session expired. Please Login again. <a href='./index_login.php'></a>";
        }
include_once './inc/footer.php';
?>

</body>

</html>