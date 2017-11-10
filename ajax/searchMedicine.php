<?php

include_once "../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$strMedicineName = $_GET["medicine_name"];




$sql1 = "select * from medicine_master a where a.medicine_name like '".$strMedicineName."%' 
        and a.MEDICINE_STATUS = 'ACTIVE' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
$result1 = mysql_query($sql1)or die(mysql_error());
$no = mysql_num_rows($result1);

if($no > 0){
        
        echo "<table class='table table-striped'><thead>
        <th>Medicine Name</td>
       
        <th>ACTION</td>
        </thead><tbody>";
        
        
        while($d1 = mysql_fetch_array($result1)){
           echo "<tr>
                <td>".$d1['MEDICINE_NAME']."</td>
                
                <td><button class='btn btn-info' onclick='editMedicine(".$d1['MEDICINE_ID'].");' >EDIT</button>
                    <button class='btn btn-warning' onclick='deleteMedicine(".$d1['MEDICINE_ID'].");' >DELETE</button>
                </td>
            </tr>";
            
        }
        echo "</tbody></table>";
    } else {
    	
    }
}else {
	echo "Session expired";
}
?>
