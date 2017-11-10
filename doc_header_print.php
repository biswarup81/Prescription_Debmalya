<!--BEGIN header-->
		<?php if(isset($_SESSION['chamber_name'])) {
            include_once "datacon.php"; 
            include_once "classes/admin_class.php" ;
            
		    $chamber_id = $_SESSION['chamber_name'];
		    
		    $admin_obj = new admin();
		    
		    $obj = $admin_obj->getChamberDetails($chamber_id);
		//fetch the header information
		
		    //echo $obj->chamber_header;
		    
		   ?>
<!--BEGIN logo-->

<div class="content">
        <div class="col-md-8-print"> 
        <div id='prescription_doc_name'>Dr. Soumyabrata Roy Chowdhuri</div>
            MBBS, * Masters in Diabetology<br>
			*Post Graduate Diplomate in Geriatric Medicine<br>
			*Post Graduate Certification in Diabetes & Endocrinology<br>
			 (Univ. of New Castle, Australia)<br>
			PHYSICIAN - Diabetes, Endocrine & Metabolic Disorders<br>
			Department of Endocrinology KPC Medical College & Hospitals<br></div>
        <div class="col-md-4-print"><b>Membership & Affiliations</b>:<br> ADA- American Diabetes Association <br>
			EASD- European Association for Study of Diabetes<br/>
            *RCPS &* RCGP [UK](INTL AFFILATE)<br>
			Endocrine Society (US)<br>
            
            <img src="images/phone.png" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<b>+91.9830047300 (M)</b><br/>
			<img src="images/phone.png" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<b>033-40704046 (Chamber)</b><br/>
            <img src="images/email.png" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<b>soumya.askme@gmail.com</b><br/>
            
            </div>
      </div>
        
 <?php }?>

<!--END of header-->