<?php
include "../inc/datacon.php";
include "../classes/admin_class.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$ci = $_GET["CI"];


$sql1 = "SELECT a.clinical_impression_id, a.prescription_id, b.visit_id, c.patient_id,
d.GENDER, d.patient_first_name, d.patient_last_name, d.patient_name, d.patient_city, d.patient_dob, 
TIMESTAMPDIFF(YEAR,d.patient_dob,c.visit_date) as patient_age, d.age, d.patient_cell_num, d.data_entry_date, d.patient_address, d.patient_email, c.visit_date
FROM prescribed_cf a, prescription b, visit c, patient d, clinical_impression e
WHERE e.TYPE ='".$ci."'
and e.ID = a.clinical_impression_id
and a.prescription_id=b.prescription_id
and b.visit_id = c.visit_id
AND a.doc_id = e.doc_id
AND a.chamber_id = e.chamber_id
and c.patient_id = d.patient_id AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'
ORDER BY d.patient_first_name ASC";

//echo $sql1;

//$sql1 = "select * from patient where patient_id != ''".$where;
$result1 = mysql_query($sql1)or die(mysql_error());
$no = mysql_num_rows($result1);
   
if($no > 0){
        
        echo "<table class='table table-striped'>
        <tr><th colspan='8'><a href='./util/excelDownloader.php?CI=".$ci."'>Export to Excel</a></th><tr>    
        <tr>
        <th>#</th>
        <th>Prescription ID</th>
        <th>Name</th>
        <th>Date of Birth</th>
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