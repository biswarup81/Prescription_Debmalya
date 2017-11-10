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
                     
            
            
            
        </script>

    <body>
        <?php
        if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])){
            $chamber_name = $_SESSION['chamber_name'];
            $doc_name= $_SESSION['doc_name'];
            /* if($_SESSION['user_type'] == 'DOCTOR'){
              header("location:visit_list.php");
              } else if($_SESSION['user_type'] == 'RECEPTIONIST'){ */
            ?>


                <div class="container">
                   <?php include("banner.php") ?>


                            <div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Reports</div>



                                    <div id="tabs" >            
                                                                               
                                        <ul class="nav nav-tabs">
										  <li class="active"><a data-toggle="tab" href="#tab1">By Clinical Impression</a></li>
										  <li><a data-toggle="tab" href="#tab2">By Patient Id</a></li>
										  <li><a data-toggle="tab" href="#tab3">By Investigation name</a></li>
										  <li><a data-toggle="tab" href="#tab4">By Medicine name</a></li>
										</ul>

                                        <!--BEGIN tab1-->
                                        <div id="tab1" class="tab-pane fade in active">



                                            <!--BEGIN search-->
                                            <div id="tab111" class="check_fields">

                                                <span><p>Clinical Impression</p>
                                                   
                                                <input id="txtCI" name="patient_cl_imprssn" type="text" class="input_box_big" value="" /></span>                
                                                           
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="search1();" /></span>


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
                                                <span><p>Patient ID</p><input id="patient_id" name="patient_id" type="text" class="form-control" placeholder="Enter patient Id" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchPatient();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                            <div class="row">
                                            	 <div class='loading' hidden='true' id='wait1'>Please Wait.. untill system finds the result for you. Thank you......</div>

                                            	
                                                <div class="col-xs-12 .col-sm-6 .col-lg-8" id="searchPatientDiv">
    
                                                    <!--RESULT OF SEARCH -->
    
    
                                                </div>
                                            </div>
                                            <!--END of results-->

                                        </div>
                                        <!--END of tab2-->
                                        
                                        
                                        <!--BEGIN tab3-->
                                        <div id="tab3" class="tab-pane fade">


											
                                            <!--BEGIN search-->
                                            <div id="tab113" class="row">
                                                 <div class="col-md-4">
                                                <label for="invest_name">Investigation Name</label>
                                                <input type="text" class="form-control" id="invest_name" name="invest_name" placeholder="Enter investigation name" >
                                              </div>
                                              <div class="col-md-3" id="lower_range_div" hidden="true">
                                                <label for="lower_range">Lower range</label>
                                                <input type="text" class="form-control" id="lower_range" placeholder="Enter Lower range" >
                                              </div>
                                              <div class="col-md-3" id="upper_range_div" hidden="true">
                                                <label for="upper_range">Upper range</label>
                                                <input type="text" class="form-control" id="upper_range" placeholder="Enter upper range" >
                                              </div>
                                              
                                             
                                    
                                            </div>
                                            <input type="button" value="Search" name="search" class="btn btn-default" onclick="searchInvestigation();" >
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                            <div class="row">
                                                <div class="col-md-8">
        		
                                            		<table id="report_by_patient_inv" class="table table-striped">
                                    		              <thead>
                                    							<tr>
                                    								<th>Investigation Name</th>
                                    								
                                    								<th>Value</th>
                                    								<th>Ageof the patient</th>
                                    								
                                    							</tr>
                                    						</thead>
                                    						<tfoot>
                                    							<tr>
                                    								<th>Investigation Name</th>
                                    								
                                    								<th>Value</th>
                                    								<th>Ageof the patient</th>
                                    								
                                    							</tr>
                                    						</tfoot>
                                    		              </tbody>
                                                	</table>
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
                                                <span><p>By Medicine Name</p><input id="course1" name="course" type="text" class="form-control" placeholder="Enter Medicine name" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchReportByMedicine();" /></span>
												<input id='hidden_prescribed_medicine_id' type='hidden'>

                                            </div>
                                            <!--END of search-->
											 <!--BEGIN search results-->
                                            <div class="row">
                                            

                                                <div class='loading' hidden='true' id='wait_search_medicine'>Please Wait.. untill system finds the result for you. Thank you......</div>


                                            <div class="col-xs-12 .col-sm-6 .col-lg-8" id="searchMedicineDiv">

                                                <!--RESULT OF SEARCH -->


                                            </div>
                                            </div>
                                            <!--END of results-->
                                           

                                        </div>
                                        <!--END of tab4-->
                                        
                                        </div>

				<!--BEGIN footer-->
                <?php include "footer_pg.php"; ?> 
                <!--END of footer-->
                </div><!-- End container -->

        
    <?php include_once './inc/footer.php';?>
</body>
<?php } else {
echo "You are not authorize to view this page";
}?>
</html>