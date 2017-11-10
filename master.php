<?php include_once "./inc/datacon.php"; ?>
<?php include_once "./inc/header.php"; 
?>
<?php if( isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])) { ?>

<?php include "header.html"; ?>

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
            
            
            
        
        
        
        function deleteInvest(investID){
            
            //alert(medincineID);
            var invest_name = document.getElementById("invest_name").value;
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchInvestDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editInvestigation.php?MODE=DELETE&investID="+investID+"&invest_name="+invest_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
                
        }
        
        
        
        function upDateInvest(investID){
            
            var inv_name = document.getElementById("inv_name").value;
            var invest_name = document.getElementById("invest_name").value;
            
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchInvestDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editInvestigation.php?MODE=UPDATE&investID="+investID+"&invest_name="+invest_name+"&inv_name="+inv_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
        }
        
        
        function deleteMedicine(medincineID){
            
            alert(medincineID);
            var medicine_name = document.getElementById("course").value;
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchMedicineDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editMedicine.php?MODE=DELETE&medincineID="+medincineID+"&medicine_name="+medicine_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
                
        }
        
        function editMedicine(medincineID){
            
            //alert(medincineID);
            var medicine_name = document.getElementById("course").value;
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchMedicineDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editMedicine.php?MODE=EDIT&medincineID="+medincineID+"&medicine_name="+medicine_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
                
        }
        
        function upDateMedicine(medicineID){
            
            var med_name = document.getElementById("med_name").value;
            var medicine_name = document.getElementById("course").value;
            
            alert(medicineID);
            alert(med_name);
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchMedicineDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editMedicine.php?MODE=UPDATE&medincineID="+medicineID+"&medicine_name="+medicine_name+"&med_name="+med_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
        }
        </script>
        <script>

            $(function() {
                $( "#datepicker" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showOn: "button",
                    buttonImage: "images/calendar.gif",
                    buttonImageOnly: true,
                    dateFormat: "dd-mm-yy"
                });
            });

        </script>


    <body>
        <?php
        if (isset($_SESSION['user_type'])) {
            /* if($_SESSION['user_type'] == 'DOCTOR'){
              header("location:visit_list.php");
              } else if($_SESSION['user_type'] == 'RECEPTIONIST'){ */
            ?>

            
                <div class="container">
                    <!--BEGIN header-->
                    <?php include("banner.php"); ?>


                            <div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Master Management</div>



                                    <div id="tabs" >            
                                        <ul class="nav nav-tabs">
										  <li class="active"><a data-toggle="tab" href="#tab1">Patient Master</a></li>
										  <li><a data-toggle="tab" href="#tab2">Medicine Master</a></li>
										  <li><a data-toggle="tab" href="#tab3">Investigation Master</a></li>
										  <li><a data-toggle="tab" href="#tab4">Clinical Feature Master</a></li>
										</ul>
										<div class="tab-content">
                                        <!--BEGIN tab1-->
                                        <div id="tab1" class="tab-pane fade in active">



                                            <!--BEGIN search-->
                                            <div id="tab111" class="check_fields" >

                                                <span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="form-control" placeholder="Enter patient Id" /></span>                
                                                <span><p>Patient Name</p><input id="s_p_name" name="patient_name" type="text"class="form-control" placeholder="Enter patient name" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="search_Patient_for_master();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                            <div class="row">
                                            

                                                <div class='loading' hidden='true' id='wait'>Please Wait.. untill system finds the result for you. Thank you......</div>


	                                            <div class="col-xs-12 .col-sm-6 .col-lg-8" id="searchDiv">
	
	                                                <!--RESULT OF SEARCH -->
	
	
	                                            </div>
                                            </div>
                                           
                                            <!--END of results-->

                                        </div>
                                        <!--END of tab1-->
                                        
                                        <!--BEGIN tab2-->
                                        <div id="tab2" class="tab-pane fade">



                                            <!--BEGIN search-->
                                            <div id="tab112" class="check_fields">
                                                <!--    
                                                <span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="input_box_add" value="" /></span>                
                                                -->
                                                <span><p>Medicine Name</p><input type="text" name="medicine_name" id="course" class="form-control" placeholder="Enter Medicine name" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchMedicine();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                           
                                            
                                            <div class="row">
                                            

                                                <div class='loading' hidden='true' id='wait1'>Please Wait.. untill system finds the result for you. Thank you......</div>


	                                            <div class="col-xs-12 .col-sm-6 .col-lg-8" id="searchMedicineDiv">
	
	                                                <!--RESULT OF SEARCH -->
	
	
	                                            </div>
                                            </div>
                                            <!--END of results-->

                                        </div>
                                        <!--END of tab2-->
                                        
                                        
                                        <!--BEGIN tab3-->
                                        <div id="tab3" class="tab-pane fade">



                                            <!--BEGIN search-->
                                            <div id="tab113" class="check_fields">
                                                <!--    
                                                <span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="input_box_add" value="" /></span>                
                                                -->
                                                <span><p>Investigation Name</p><input id="invest_name" name="invest_name" type="text" class="form-control" placeholder="Enter Investigation name" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchInvestigation();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                                                                        
                                            <div class="row">
                                            

                                                <div class='loading' hidden='true' id='wait2'>Please Wait.. untill system finds the result for you. Thank you......</div>


	                                            <div class="col-xs-12 .col-sm-6 .col-lg-8" id="searchInvestDiv">
	
	                                                <!--RESULT OF SEARCH -->
	
	
	                                            </div>
                                            </div>
                                            <!--END of results-->

                                        </div>
                                        <!--END of tab3-->
                                        
                                        <!--BEGIN tab4-->
                                        <div id="tab4" class="tab-pane fade">



                                            <!--BEGIN search-->
                                            <div id="tab114" class="check_fields">
                                                <!--    
                                                <span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="input_box_add" value="" /></span>                
                                                -->
                                                <span><p>Clinical Feature Name</p><input id="cf_name" name="invest_name" type="text" class="form-control" placeholder="Enter Investigation name" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchClinicalFeature();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                                                                        
                                            <div class="row">
                                            

                                                <div class='loading' hidden='true' id='wait2'>Please Wait.. untill system finds the result for you. Thank you......</div>


	                                            <div class="col-xs-12 .col-sm-6 .col-lg-8" id="searchCFDiv">
	
	                                                <!--RESULT OF SEARCH -->
	
	
	                                            </div>
                                            </div>
                                            <!--END of results-->

                                        </div>
                                        <!--END of tab4-->
                                        </div>
                                        
                                    </div>

			<!--BEGIN footer-->
                <?php include "footer_pg.php"; ?> 
                <!--END of footer-->
                </div><!-- End container -->

        <?php
    } /* } */ else {
        /* header("location:index_login.php"); */
        echo "<script>location.href='index_login.php'</script>";
    }
    ?>
    <?php include_once './inc/footer.php';?>
</body>
<?php } else {
echo "You are not authorize to view this page";
}?>
</html>
