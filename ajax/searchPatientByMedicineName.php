<?php
include "../inc/datacon.php";
include "../classes/admin_class.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$medicine_name = $_GET["MEDICINE_NAME"];


/* $sql1 = "SELECT a.MEDICINE_ID, a.prescription_id, b.visit_id, c.patient_id, e.MEDICINE_NAME,
d.GENDER, d.patient_first_name, d.patient_last_name, d.patient_name, d.patient_city, d.patient_dob, 
TIMESTAMPDIFF(YEAR,d.patient_dob,c.visit_date) as patient_age, d.age, d.patient_cell_num, d.data_entry_date, d.patient_address, d.patient_email, c.visit_date
FROM precribed_medicine a, prescription b, visit c, patient d, medicine_master e
WHERE e.MEDICINE_NAME like '".$medicine_name."%'
and e.MEDICINE_ID = a.MEDICINE_ID
and a.prescription_id=b.prescription_id
and b.visit_id = c.visit_id
ORDER BY d.patient_first_name ASC"; */

$sql1 = "SELECT a.MEDICINE_ID, a.prescription_id, b.visit_id, c.patient_id, e.MEDICINE_NAME, d.GENDER, d.patient_first_name, d.patient_last_name, d.patient_name, d.patient_city, d.patient_dob, TIMESTAMPDIFF( YEAR, d.patient_dob, c.visit_date ) AS patient_age, d.age, d.patient_cell_num, d.data_entry_date, d.patient_address, d.patient_email, c.visit_date
FROM precribed_medicine a, prescription b, visit c, patient d, medicine_master e
WHERE e.MEDICINE_NAME LIKE '".$medicine_name."%'
AND e.MEDICINE_ID = a.MEDICINE_ID
AND a.prescription_id = b.prescription_id
AND b.visit_id = c.visit_id
AND c.PATIENT_ID = d.patient_id
ORDER BY d.patient_first_name ASC";


//echo $sql1;

//$sql1 = "select * from patient where patient_id != ''".$where;
$result1 = mysql_query($sql1)or die(mysql_error());
$no = mysql_num_rows($result1);
   
if($no > 0){
        
        echo "<table class='table table-striped'>
        <tr><th colspan='8'><a href='./util/excelDownloader.php?MEDICINE_NAME=".$medicine_name."'>Export to Excel</a></th><tr>    
        <tr>
        <th>#</th>
        <th>Prescription ID</th>
        <th>Name</th>
        <th>Age</th>
		<th>Medicine name</th>
        <th>Mobile No</th>
        <th>City / Town</th>
        <th>Visit Date</th>

        </tr>";
        
        
        while($d1 = mysql_fetch_array($result1)){
           echo "<tr>
                <td>".$d1['patient_id']."</td>
                <td>".$d1['prescription_id']."</td>
                <!--<td><a href='processData.php?patient_id=".$d1['patient_id']."' class='vlink'>".$d1['patient_id']."</a></td> -->
                <td>"; if($d1['patient_first_name'] == '') { echo $d1['patient_name']; }else{ echo $d1['patient_first_name']. " ".$d1['patient_first_name'];} 
                echo "</td>
                

                        
                <td>";
           
                        if($d1['age'] == 0){
                            echo $d1['patient_age'];
                        }else {
                            echo $d1['age'];
                        }
                        
                echo "</td>
				<td>".$d1['MEDICINE_NAME']."</td>
                <td>".$d1['patient_cell_num']."</td>
                <!--<td>".$d1['patient_address']."</td> --> 
                
                <td>".$d1['patient_city']."</td>
               
                
                <td><a target='_blank' class='btn btn-info' role='button'
                href='archievedprescription.php?PRESCRIPTION_ID=".$d1['prescription_id']."&visit_id=".$d1['visit_id']."&patient_id=".$d1['patient_id']."'>".date("d-m-y", strtotime($d1['visit_date']))."</a>
            </td>

            </tr>";
            
        }
        echo "</table>";
    }else{
            echo "<div class='alert alert-danger' role='alert' >No Result found !!    </div>";
    }
}else {
	echo "Session expired";
}
?>