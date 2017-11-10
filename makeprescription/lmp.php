    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->LMP </div>
    <div class="inner_lmp">


    <p>
                

            <?php
                 $q11 = "SELECT b.LMP_DATE
                        FROM prescription a, lmp b
                        WHERE a.PRESCRIPTION_ID = '$PRESCRIPTION_ID' and a.STATUS = 'SAVE'
                        AND a.PRESCRIPTION_ID = b.PRESCRIPTION_ID and a.chamber_id='".$chamber_name."' AND a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id";
                            //echo $q5;
                    
                            $result = mysql_query($q11) or die(mysqli_error()); 
                            

                            while($rs = mysql_fetch_array($result)) {
            ?>
                <?php echo date("d / m / Y", strtotime($rs['LMP_DATE'])); ?> &nbsp; &nbsp;
            <?php    } ?>
    </p> 
    <div class="clear"></div>


<input id="theDate" name="theDate" type="text" class="input_box_small" value="" onfocus="myFocus(this);" onblur="myBlur(this);" />

				
    </div>
    <div class="others">
    <div class="other_headings"><!--<img src="images/Briefcase-Medical.png" />-->History </div>
    <div class="inner_history">

    <?php include_once 'pre_prescriptions.php';?>



<!-- Get In Touch Ends -->					
    </div>

</div>