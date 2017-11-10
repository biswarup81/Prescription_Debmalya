<?php

include_once "../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
	
	$cf_name= $_GET["cf_name"];
	
	
	
	
	$sql1 = "select * from patient_health_details_master a where a.NAME like '".$cf_name."%'
	and a.STATUS = 'ACTIVE' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
	$result1 = mysql_query($sql1)or die(mysql_error());
	$no = mysql_num_rows($result1);
	
	if($no > 0){
		
		echo "<table class='table'><thead><tr>
		<th class='head_tbl'>ID</td>
        <th class='head_tbl'>C/F Name</td>
				
        <th class='head_tbl'>ACTION</td>
        </tr></thead><tbody>";
		
		
		while($d1 = mysql_fetch_array($result1)){
			echo "<tr>
				<td>".$d1['ID']."</td>
                <td>".$d1['NAME']."</td>
                		
                <td><button class='btn btn-warning' onclick='deleteCF(".$d1['ID'].") ' class='vlink'>DELETE</button>
                </td>
            </tr>";
			
		}
		echo "</tbody></table>";
	}else{
		echo "No Result found.";
	}
	
}else {
	echo "Session expired";
}
?>
