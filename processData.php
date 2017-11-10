<?php
include_once "./inc/datacon.php";
include_once './inc/header.php';
if(isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name']) ){
    
include_once 'classes/admin_class.php';
$admin = new admin();
?>
<div class="container"><!-- Begin container -->

<div class="row">
                                            
     <div class='loading' id='wait'>Please Wait.. System is preparing prescription..</div>
</div>
<?php 
if(isset($_GET['patient_id'])){
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
    $user_name= $_SESSION['user_name'];
    
    $_SESSION['page']='processData';
    
    $patient_id = $_GET['patient_id'];
    $_SESSION['patient_id'] = $patient_id;
    
    $result = mysql_query("select * from visit where patient_id = '$patient_id' and doc_id =  '$doc_name' and chamber_id = '$chamber_name' and visited = 'no'");
    
    //echo $result;
    
    
    /** START : BLOCK FOR GENERATING VISIT ID   **/
    if(mysql_num_rows($result) > 0){
        //Visit exists. Get the visit id
        while($rows = mysql_fetch_array($result)){
            $existing_visit_id = $rows['VISIT_ID'];
        }
        
        //echo "visit exists -> ".$existing_visit_id;
        
    } else {
        //echo "No stored visit";
        $existing_visit_id = $admin->getMaxVisitId($chamber_name, $doc_name);
        //echo "System will create visit id = ".$existing_visit_id;
        //No visit for the patient. So create a visit with respect to the patient id.
        mysql_query("insert into visit (VISIT_ID, patient_id,VISIT_DATE,chamber_id, created_by_user_id, doc_id ) 
            values( '".$existing_visit_id."', '".$patient_id."', NOW(),'".$chamber_name."','".$user_name."','".$doc_name."' )") or die(mysql_error());
        //$existing_visit_id = mysql_insert_id();
        //echo "System Creats visit id = ".$existing_visit_id;
    }
    /** END : BLOCK FOR GENERATING VISIT ID   **/
    
    //Get the last visited record
    $result1 = mysql_query("select max(visit_id) as visit_id from visit where patient_id = '".$patient_id."' and visited = 'yes' and doc_id =  '$doc_name' and chamber_id = '$chamber_name'" );
    
    
    /** START : BLOCK FOR COPYING THE OLD INVESTIGATION REPORT FOR THE PATIENT **/
    
    
    if(mysql_num_rows($result1) > 0){
        //echo "Already visited. So fetch the visit id (visited_id) for the last visit\n";
        //Already visited. So fetch the visit id (visited_id) for the last visit
        while($rows = mysql_fetch_array($result1)){
            $visited_id = $rows['visit_id'];
        }
        
        //echo "visit id of last visit is ".$visited_id."\n";
        //Populate patient investigation for old record.
        /** START INSERTING OLD PATIENT INVESTIGATION **/
        //INsert into patient_investigation
        
        $result2 = mysql_query("select * from patient_investigation where patient_id  = '".$patient_id."'and visit_id='".$visited_id."' and doc_id =  '".$doc_name."' and chamber_id = '".$chamber_name."'");
        
        while($existingRows = mysql_fetch_array($result2)){
            $inv_id = $existingRows['investigation_id'];
            $VALUE = $existingRows['value'];
            
            //Check if the record already exists or not
            $checkQuery = "select * from patient_investigation where patient_id = '".$patient_id."'
                        and visit_id = '".$existing_visit_id."' and investigation_id = '".$inv_id."' and doc_id =  '".$doc_name."' and chamber_id = '".$chamber_name."'";
            $result = mysql_query($checkQuery);
            
            if(mysql_num_rows($result) <= 0) {
                
                //echo "Populate patient investigation with old data\n";
                
                $query_insert_into_patient_investigation = "insert into patient_investigation (patient_id, visit_id, investigation_id, value, chamber_id, doc_id, created_by_user_id)
                                                    values ('".$patient_id."','".$existing_visit_id."','".$inv_id."','".$VALUE."','".$chamber_name."','".$doc_name."','".$user_name."')";
                
                mysql_query($query_insert_into_patient_investigation) or die(mysql_error());
                //echo "patient investigation with old data is populated...\n";
            }
        }
        /** END: INSERTING OLD PATIENT INVESTIGATION **/
        
        /** START INSERTING OLD PATIENT INVESTIGATION BY RECEPTIONIST **/
        //INsert into patient_health_details_by_receptionist
        
        $result3 = mysql_query("select * from patient_health_details where visit_id='".$visited_id."' and doc_id =  '".$doc_name."' and chamber_id = '".$chamber_name."'") or die(mysql_error());
        
        while($existingRows1 = mysql_fetch_array($result3)){
            
            $id=$existingRows1['ID'] ;
            $value=$existingRows1['VALUE'];
            if($id == 1 ){
                
                $checkQuery2 = "select * from patient_health_details where ID = '".$id."'
                        and VISIT_ID = '".$existing_visit_id."' and doc_id =  '".$doc_name."' and chamber_id = '".$chamber_name."' ";
                $result4 = mysql_query($checkQuery2);
                if(mysql_num_rows($result4) <= 0) {
                    $query_insert_into_patient_health_details = "insert into patient_health_details
                            (ID, VALUE, VISIT_ID, doc_id, chamber_id, created_by_user_id) values ('".$id."','".$value."','".$existing_visit_id."','".$doc_name."','".$chamber_name."','".$user_name."')";
                    mysql_query($query_insert_into_patient_health_details) or die(mysql_error());
                }
            }
            
        }
        
        /** END INSERTING OLD PATIENT INVESTIGATION BY RECEPTIONIST **/
        
    } else {
        // There is no visited id. NO OPERATION TO BE PERFORMED
    }
    /** END : BLOCK FOR COPYING THE OLD INVESTIGATION REPORT FOR THE PATIENT **/
    
    //header("location:reception.php");
    /* header("location:visit_list.php"); */
    echo "<script>location.href='visit_list.php'</script>";
    
}
?>
</div>
<?php } else {
    echo "You are not authorize to perform this operation";
}
?>
<?php include_once './inc/footer.php';?>
</body>
</html>