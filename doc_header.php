<!--BEGIN header-->

		<?php if(isset($_SESSION['chamber_name'])) {
            include_once "./inc/datacon.php"; 
            include_once 'classes/prescription_header.php';
            
		    $chamber_id = $_SESSION['chamber_name'];
		    $doc_name = $_SESSION['doc_name'];
		    $header = new Header($doc_name,$chamber_id);
		    
	
		    
		   ?>
<!--BEGIN logo-->

<div class="row">
        <div class="col-md-8"> 
        <div id='prescription_doc_name'><?php echo $header->doctor_full_name;?></div>
            <?php echo $header->doctor_degree;?></div>
        <div class="col-md-4"><b>Membership & Affiliations</b>:<br> <?php echo $header->doctor_affiliation;?>
            
            <img src="images/phone.png" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<b><?php echo $header->doctor_mobile;?> (M)</b><br/>
			<img src="images/phone.png" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<b><?php echo $header->primary_phone_number;?> (Chamber)</b><br/>
            <img src="images/email.png" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<b><?php echo $header->doctor_email;?></b><br/>
            
            </div>
      </div>
        
 <?php }?>

<!--END of header-->