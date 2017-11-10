<?php include_once "./inc/datacon.php"; ?>
<?php
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
if(isset($_SESSION['user_type']) ){
if(isset($_GET['PRESCRIPTION_ID'])){

?>

 
<?php 
if($_SESSION['doc_name'] == '1'){
    include_once ("./inc/header_print_dsanyal.php") ;
} else if ($_SESSION['doc_name'] == 'sroy'){
include_once "./inc/header_print_sroy.php";
} else if ($_SESSION['doc_name'] == 'hindol'){
    include_once "./inc/header_print_hindol.php";
} else {
	include_once "./inc/header_print.php";
}
?>
<body>
            <div class="print_container" id="printArea">
        
            <!--BEGIN header-->
            <?php 
            
            include_once "classes/admin_class.php"; 
            include_once 'classes/prescription_header.php';
	            $update= new admin();
	            $prescription_id = $_GET['PRESCRIPTION_ID'];
	            $d1 = $update->getPatientInformationforArchievePrescription($prescription_id, $chamber_name, $doc_name);
	            $_SESSION['visit_date'] = $d1->VISIT_DATE;
	            $chamber_id = $_SESSION['chamber_name'];
	            
	            $admin_obj = new admin();
	            
	            $obj = $admin_obj->getChamberDetails($chamber_id);
	            $doc_name = $_SESSION['doc_name'];
	            $header = new Header($doc_name,$chamber_id);
	            
            ?>
            
            
            <div class="content">
            <!-- IF DSANYAL -->
            <?php if($doc_name == '1'){?>
            	 <div class="col-md-8-print"> 
                    <div id='prescription_doc_name'><?php echo $header->doctor_full_name;?></div>
                        <?php echo $header->doctor_degree;?></div>
                    <div class="col-md-4-print">
                    <img src="images/phone.png" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<b><?php echo $header->doctor_mobile;?> (M)</b><br/>
                        <img src="images/email.png" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<b><?php echo $header->doctor_email;?></b><br/><br/>
                        <u><b>Ananda Clinic</b></u><br/>
                        <?php echo $header->chamber_address;?><br/>
                        Phone : <?php echo $header->primary_phone_number;?> / <?php echo $header->secondary_phone_number;?><br/>
                        <u><b>Chamber(By Appointment)</b></u><br/>
                        <?php echo $header->doctor_address;?>
                    
                  </div>
            <?php } else if($doc_name == 'hindol') { ?><!-- ELSE -->
		        <div class="wrapper"><!-- wrapper start -->
    	<div class="header-top">
        	<div class="left">
            	<h1><?php echo $header->doctor_full_name;?></h1>
                <h6><strong><?php echo $header->doctor_degree;?></strong></h6>
            </div>
        	<div class="right tr">
            	<h1><?php echo $header->chamber_name;?></h1>
                <h6><strong><?php echo $header->chamber_address;?>,<br><?php echo $header->primary_phone_number;?> / <?php echo $header->secondary_phone_number;?></strong></h6>
                <h6><strong>By Appointment : 6 pm to 8 pm<br>Monday to Friday</strong></h6>
            </div>
        </div>     </div>
				<?php }?>
			
			
	      </div>	
          <!--END of header-->
          <!-- Begin Patient Details -->
          <div class="content_patient_details" >
                        
                        #  <?php echo $d1->patient_id; ?>, <?php if($d1->patient_name == null || $d1->patient_name == ""){
                            echo $d1->patient_first_name." ".$d1->patient_last_name; } else { echo $d1->patient_name ; }?>, <?php echo $d1->GENDER ?>, <?php 
                        
                        if($d1->age == 0){
                            print $update->calcAge1($d1->patient_dob, $d1->VISIT_DATE) ;
                        }else {
                            echo $d1->age;
                        } ?>
					(<?php echo $d1->patient_address . ", " . $d1->patient_city; ?>, Ph: <?php echo $d1->patient_cell_num; ?>)
          </div>
            
           <!-- End Patient Details -->
           
           
           <div class="row">
            
                <!--BEGIN block one-->
                <div class="block"> 
                    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Clinical Impressions</div>
                    <div class="inner">
                    <table>
                        <?php
                            $q15 = "SELECT b.type
                                    FROM prescribed_cf a, clinical_impression b
                                    WHERE a.clinical_impression_id = b.id
                                    AND a.prescription_id = '".$_GET['PRESCRIPTION_ID']."' and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id";
                            $rsd1 = mysql_query($q15)  or die(mysql_error()); 
                            while($rs = mysql_fetch_array($rsd1) ) { ?>
                                <tr> <td ><?php echo $rs['type']; ?></td> </tr>
                               <?php 
                               
                            }
                        ?>
                    </table>
                    </div>        
                </div>
                
                <!--BEGIN block two-->
                <div class="block" >
                    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Investigation Done</div>
                    <div class="inner">
                        <table>
                            
                        <?php
    $result = mysql_query("SELECT b.investigation_name, a.value, b.unit
                            FROM patient_investigation a, investigation_master b
                            WHERE a.patient_id = '".$_GET['patient_id']."'
                            AND a.visit_id = '".$_GET['visit_id']."'
                            AND a.investigation_id = b.ID and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id");
    
    while($rows = mysql_fetch_array($result) ){
    
?>
                           
                      <tr>
                        <td ><?php echo $rows['investigation_name']; ?></td>
                        <td ><?php echo $rows['value']; ?></td>
                        <td ><?php echo $rows['unit']; ?></td>
                        
                      </tr>
                          
                       
                        <?php } ?>
                          
                        </table>
                    </div>   
                
                </div>
                <!--END of block two-->
                
                <!--BEGIN block three-->
                <div class="block">
                    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;C/F </div>
                    <div class="inner">
                        
                    <!-- Get In Touch Starts -->
                    <?php
					
                    $visit_id = $_GET['visit_id'];
                    
                    $q15 = "select a.VALUE, b.NAME, a.ID from
                                patient_health_details a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '".$_GET['visit_id']."' and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id";
					 $rsd1 = mysql_query($q15);

                            while($rs = mysql_fetch_array($rsd1)) {
                                    $name = $rs['NAME'];
                                    $value = $rs['VALUE'];
                                    $id = $rs['ID'];
                    ?>
                    <table>      
                        
                        <tr>
                            <td width="100%" ><?php echo $name; ?></td>
                            <td width="100%" ><?php echo $value; ?></td> 
                        </tr> 
                       
                    </table> 
                    <?php    } ?>
                <!-- Get In Touch Ends -->					
                </div>
           
                
              </div>
              <!--END of block three-->

              <?php if($doc_name == "hindol") {?><div class='block_lungs'><img src="images/lnc.jpg"  /></div> <?php }?>
            
            </div>
            <!--END of content-->
            <?php 
                    $prescriptionid = $_GET['PRESCRIPTION_ID'] ;
                    
                    $query = "select * from prescription a where a.PRESCRIPTION_ID = 
                        '".$prescriptionid."' and a.VISIT_ID = '".$visit_id."' and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' ";
                    $result = mysql_query($query);
                    $diet1 = "";
                    $nextvisit1 = "";
                    while($rs = mysql_fetch_array($result)){
                        $diet1 = $rs['DIET'];
                        $nextvisit1 = $rs['NEXT_VISIT'];
                        $other_comment = $rs['ANY_OTHER_DETAILS'];
                    }
                ?>
            <!--BEGIN diet section-->
           
            <div class="diet">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Diet & Lifestyle Recommendation</div>
                <div class="invest_inner">        
                <?php echo $diet1; ?>
                </div>
            
            </div>
            <!-- END DIATE -->
            <!--BEGIN rx section-->
            
            <div class="invest_rx"><div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Rx (Prescription)</div>    
                <div class="col-xs-12 .col-sm-6 .col-lg-8">      
                
                    <?php
                        $q11 = "SELECT * FROM precribed_medicine a WHERE a.PRESCRIPTION_ID = '".$_GET['PRESCRIPTION_ID']."' and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' ";
                            //echo $q5;
                
                            $result = mysql_query($q11) or die(mysql_error()); 
                    ?>
                    
                    
                        <table id="table-3" class="table"> 
                        <?php while($rs = mysql_fetch_array($result)) { ?>

                            <tr>
                                <td class='medicine_desc'>
                                    <img src="images/stock_list_bullet.png"/>&nbsp<strong><?php echo $rs['MEDICINE_NAME'] ?></strong>
                                    
                                    <img src="images/arrow-right.png" />
                                        <i><?php echo $rs['MEDICINE_DOSE'] ?></i></td>
                               

                            </tr>

                        <?php } ?>
                        </table>
                    
                </div>
            
            </div>
            <!--END of rx section-->
            
            <!--BEGIN doctor comment section-->
            <div class="diet">    
                
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Other Advice (if any)</div>
                <div class="invest_inner"> <?php echo $other_comment; ?>  </textarea>
                </div>
            
            </div>
           
            
            <!--BEGIN special section-->
            <div class="invest">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Prescribed Investigation</div>
                <div class="invest_inner">        
                
                        
                    
                            <div class="check_fields" >
                                <?php
                                $query = "SELECT b.investigation_name
                                        FROM prescribed_investigation a, investigation_master b
                                        WHERE a.investigation_id = b.ID
                                        AND prescription_id = '".$_GET['PRESCRIPTION_ID']."' and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id";
                                $result = mysql_query($query);
                                    while($rs = mysql_fetch_array($result)) {
                                            $cname = $rs['investigation_name'];
                                            //$inv_id =$rs['ID'];
                                            echo $cname. ", ";
                                    }
                                ?>
                            </div>      
                                       
                        
                </div>
                
                
            
            </div>
            
            <!--BEGIN diet section-->
            
            
            
            
            <div class="diet">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Patient's Next Visit</div>
                <div class="invest_inner">        
                <?php echo $nextvisit1; ?>
                </div>
            
            </div>
            
            
            <!--END of rx special-->
            
            <!--BEGIN submit button-->
                <div class="btn_wrap">
                    
                    
                    &nbsp;</div>
            <!--END of submit button-->
                      
            <!--BEGIN footer-->
            
            <?php 
	
	$visit_date = $_SESSION['visit_date'];
	
	?>
	
<div class="row2">
        <div class="col-md-8-print"> Date : <?php echo $visit_date; ?><br>Ref # ( <?php echo $_GET['PRESCRIPTION_ID']; ?> / <?php echo $_GET['visit_id']; ?> / <?php echo $_GET['patient_id']?>) </div>
        <div class="col-reg-num" align="right"><b>(<?php echo $header->doctor_full_name;?>) </b><br>Reg. No. # <?php echo $header->doc_reg_num;?></div>
</div>	

<div class="row">
      
      <div class="alert alert-info" role="alert">
        <strong><?php echo $header->chamber_footer;?></strong>
      </div>
      
     
</div><!--END of footer-->
</div><!-- End container -->

            <div class="content" align="center">
        
		        <input class="btn btn-success" type="button" id="print_arch_pres" value="Print" onclick="return func_print('<?php echo $header->doctor_full_name;?>');">
		        <a class="btn btn-success" href="./visit_list.php" >Go to Visit List</a>
			</div>
           <?php 
}  

}else {
echo "Please logout and login again.";
}
} else {
echo "Session expired. Login again.";
}?> 
            
            
        	 

        <?php include_once './inc/footer.php';?>
    </body>
</html>