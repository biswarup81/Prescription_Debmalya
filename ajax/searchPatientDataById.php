<?php
include "../inc/datacon.php";
include "../classes/admin_class.php";
$admin = new admin();
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$patient_id = $_GET["PATIENT_ID"];

$obj_patient = $admin->getPatientDetailsPatientId($patient_id, $chamber_name, $doc_name);



$sql1 = "SELECT a.PRESCRIPTION_ID, a.VISIT_ID, b.PATIENT_ID , b.VISIT_DATE
        from prescription a, visit b
        where a.VISIT_ID = b.VISIT_ID AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' and
		a.chamber_id=b.chamber_id and a.doc_id=b.doc_id and
        b.PATIENT_ID = '".$patient_id."' order by b.VISIT_DATE desc";
//echo $sql1;
$result1 = mysql_query($sql1)or die(mysql_error());
$no = mysql_num_rows($result1);
echo "Details for :"; if ($obj_patient->patient_first_name != '') { echo $obj_patient->patient_first_name ." ".$obj_patient->patient_last_name;} else {echo $obj_patient->patient_name;}
echo "<table width='888' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='bg_tble'>                    
            <table width='100%' border='1' cellspacing='1' cellpadding='0'>";    
if($no > 0){
    echo "
        <!--<tr colspan='4'><td><a href='./util/excelDownloader.php?PATIENT_ID=".$patient_id."&MODE=PATIENTDATA'>Export to Excel</a></td><tr> -->   
        <tr>
        <td class='head_tbl'>Visit date</td>
        
        <td class='head_tbl'>Clinical Impression</td>
        <td class='head_tbl'>Investigation Result</td>
        <td class='head_tbl'>Medicine</td>
        
        </tr>";

while($d1 = mysql_fetch_array($result1)){
    echo "<tr>";
    echo "<td>".date("d / m / Y", strtotime($d1['VISIT_DATE']))."</td>";
    echo "<td>";
    $sql2 = "SELECT a.prescription_id, a.clinical_impression_id, b.TYPE 
        from prescribed_cf a, clinical_impression b 
        where a.clinical_impression_id 	 = b.ID AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' and
		a.chamber_id=b.chamber_id and a.doc_id=b.doc_id and
        a.prescription_id = '".$d1['PRESCRIPTION_ID']."' order by b.TYPE asc";
    $result2 = mysql_query($sql2)or die(mysql_error());
    echo "<table>";
    while($d2 = mysql_fetch_array($result2)){
        echo"<tr>";
        echo "<td>".$d2['TYPE']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</td>";
    
    echo "<td>";
    $sql3 = "SELECT a.value, b.investigation_name
        from patient_investigation a, investigation_master b
        where a.investigation_id = b.ID AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' and
		a.chamber_id=b.chamber_id and a.doc_id=b.doc_id and 
        a.visit_id = '".$d1['VISIT_ID']."' order by b.investigation_name asc";
    $result3 = mysql_query($sql3)or die(mysql_error());
    echo "<table>";
    while($d3 = mysql_fetch_array($result3)){
        echo"<tr>";
        echo "<td>".$d3['investigation_name']."  ".$d3['value']."</td>";
        echo "</tr>";
            
    }
  //  echo"<tr><td>".$sql3."</td></tr>";
    echo "</table>";
    echo "</td>";
    
    echo "<td>";
    $sql4 = "SELECT a.MEDICINE_NAME
        from precribed_medicine a
        where a.PRESCRIPTION_ID = '".$d1['PRESCRIPTION_ID']."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' order by a.MEDICINE_NAME asc";
    $result4 = mysql_query($sql4)or die(mysql_error());
    echo "<table>";
    while($d4 = mysql_fetch_array($result4)){
        echo"<tr>";
        echo "<td>".$d4['MEDICINE_NAME']."</td>";
        echo "</tr>";
    }
   
    echo "</table>";
    echo "</td>";
    
    
    
    echo "</tr>";
}

}else{
            echo "<tr><td colspan='10' align='center' style='color:red'> No Result found.</td></tr>";
    }
    echo "</table>
       </td>
    </tr>
</table>";

}else {
	echo "Session expired";
}
?>