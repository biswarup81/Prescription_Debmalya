<?php

include_once "../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];

$invest_name = $_GET["invest_name"];




$sql1 = "select * from investigation_master a where a.investigation_name like '".$invest_name."%' 
        and a.STATUS = 'ACTIVE' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
$result1 = mysql_query($sql1)or die(mysql_error());
$no = mysql_num_rows($result1);

if($no > 0){
        
        echo "<table class='table'><thead><tr>
		<th class='head_tbl'>ID</td>
        <th class='head_tbl'>Investigation Name</td>
       
        <th class='head_tbl'>ACTION</td>
        </tr></thead><tbody>";
        
        
        while($d1 = mysql_fetch_array($result1)){
           echo "<tr>
				<td>".$d1['ID']."</td>
                <td>".$d1['investigation_name']."</td>
                
                <td><button class='btn btn-info' onclick='editInvest(".$d1['ID'].") ' class='vlink'>EDIT</button>
                    <button class='btn btn-warning' onclick='deleteInvest(".$d1['ID'].") ' class='vlink'>DELETE</button>
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
