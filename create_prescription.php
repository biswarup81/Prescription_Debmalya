<?php
include_once "./inc/datacon.php";
include_once './inc/header.php';
if(isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name']) ){
include_once 'classes/admin_class.php';    
$admin = new admin();
$patient_id = $_GET['patient_id'];

$VISIT_ID = $_GET['VISIT_ID'];
$chamber_name = $_SESSION['chamber_name'];
$doc_name= $_SESSION['doc_name'];
$logged_in_user = $_SESSION['logged_in_user_id'];
?>
<div class="container"><!-- Begin container -->

<div class="row">
                                            
     <div class='loading' id='wait'>Please Wait.. System is preparing prescription..</div>
</div>
<?php //echo "Visit id =".$VISIT_ID;

// Get Prescription ID from VISIT_ID
$query2 = "select * from prescription a where a.VISIT_ID = '".$VISIT_ID."' and a.STATUS = 'DRAFT' and a.chamber_id='".$chamber_name."' AND a.doc_id='".$doc_name."' ";
//echo $query2;
$result = mysql_query($query2) or die(mysql_error());

if(mysql_num_rows($result) > 0){
    while($rows = mysql_fetch_array($result)){
    	$max_prescription_id = $rows['PRESCRIPTION_ID'];
    }
    /* header("location:prescription2.php?VISIT_ID=$VISIT_ID&patient_id=$patient_id&PRESCRIPTION_ID=$max_prescription_id");  */
    echo "<script>location.href='prescription2.php?VISIT_ID=$VISIT_ID&patient_id=$patient_id&PRESCRIPTION_ID=$max_prescription_id'</script>";
} else {
    $max_prescription_id = $admin->getMaxPrescriptionId($chamber_name, $doc_name);
    //echo "Inside else ...max_prescription_id = ".$max_prescription_id;
    
    $query_patn = "insert into prescription(PRESCRIPTION_ID, VISIT_ID, chamber_id, doc_id, created_by_user_id) 
        values('".$max_prescription_id."','".$VISIT_ID."', '".$chamber_name."','".$doc_name."','". $logged_in_user."')";
    //echo $query_patn;
    
    mysql_query($query_patn) or die(mysql_error());
    
    //mysql_query($query_patn) or die(mysql_error());
    //$PRESCRIPTION_ID = mysql_insert_id();
    
    //Create Prescription with existing Clinical Expression of the patient
  //  $query_select_clinical_impression = "select * from prescribed_cf where  prescription_id in (
    //                                select prescription_id  from prescription where visit_id in (
      //                                  select max(visit_id)  from visit where patient_id = '$patient_id' and visited='yes'))";
    
	 $query_select_clinical_impression = "SELECT *
                                                FROM prescribed_cf c
                                                WHERE c.prescription_id = (
                                                SELECT prescription_id
                                                FROM prescription b
                                                WHERE b.visit_id = (
                                                SELECT max( visit_id )
                                                FROM visit a
                                                WHERE a.patient_id = '$patient_id'
                                                AND a.visited = 'yes' and a.chamber_id='$chamber_name' AND a.doc_id='$doc_name') 
												and b.chamber_id='$chamber_name' AND b.doc_id='$doc_name' ) and c.chamber_id='$chamber_name' AND c.doc_id='$doc_name'" ;
	 //echo "<br>";
	 //echo $query_select_clinical_impression;

    $r3 = mysql_query($query_select_clinical_impression) or die(mysql_error());
    while($row = mysql_fetch_array($r3)) {
    	$q2 = "insert into prescribed_cf (clinical_impression_id 	, prescription_id, chamber_id, doc_id, created_by_user_id)
                    values('".$row['clinical_impression_id']."','".$max_prescription_id."','".$chamber_name."','".$doc_name."', '". $logged_in_user."')";
    	//echo $q2;
    	mysql_query($q2) or die(mysql_error());
    }

    //Create Prescription with existing records of a patient
    $query_pres_history = "select * from precribed_medicine c
                                where  c.prescription_id = (
                                    select prescription_id  from prescription b where b.visit_id = (
                                        select max(visit_id)  from visit a where a.patient_id = '$patient_id' and a.visited='yes' and a.chamber_id='$chamber_name' AND a.doc_id='$doc_name') and b.chamber_id='$chamber_name' AND b.doc_id='$doc_name' )  and c.chamber_id='$chamber_name' AND c.doc_id='$doc_name'";
    //echo "<br>";
    //echo $query_pres_history;
    $r3 = mysql_query($query_pres_history) or die(mysql_error());
    while($row = mysql_fetch_array($r3)) {
    	$q3 = "insert into precribed_medicine (MEDICINE_ID, PRESCRIPTION_ID, MEDICINE_NAME, MEDICINE_DIRECTION, MEDICINE_DOSE, MEDICINE_TIMING, chamber_id, doc_id, created_by_user_id)
                    values('".$row['MEDICINE_ID']."','".$max_prescription_id."','".$row['MEDICINE_NAME']."', '".$row['MEDICINE_DIRECTION']."', '".$row['MEDICINE_DOSE']."', '".$row['MEDICINE_TIMING']."','".$chamber_name."','".$doc_name."', '". $logged_in_user."')";
        mysql_query($q3)or die(mysql_error());
    }
    /* header("location:prescription2.php?VISIT_ID=$VISIT_ID&patient_id=$patient_id&PRESCRIPTION_ID=$max_prescription_id");  */
    echo "<script>location.href='prescription2.php?VISIT_ID=$VISIT_ID&patient_id=$patient_id&PRESCRIPTION_ID=$max_prescription_id'</script>";
}
?>



</div>

<?php } else {
echo "You are not authorize to perform this operation";
}?>
<?php include_once './inc/footer.php';?>
</body>
</html>