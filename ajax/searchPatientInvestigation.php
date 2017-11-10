<?php

require_once "../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
	
$invest_name = $_GET["invest_name"];

$sql1 = "select a.investigation_name, b.value, TIMESTAMPDIFF(YEAR,d.patient_dob,c.visit_date) as age
        from investigation_master a , patient_investigation b , patient d, visit c
        where a.investigation_name like '".$invest_name."%' 
        AND a.ID = b.investigation_id 
        AND b.patient_id = d.patient_id
        AND b.visit_id = c.visit_id
        AND a.chamber_id = b.chamber_id
        AND a.doc_id=b.doc_id
        AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' 
        order by b.value desc";
$result = mysql_query($sql1)or die(mysql_error());


$data = array();
	
	while ($row = mysql_fetch_array($result))
	{
		$data[] = $row;
	}
	echo json_encode(array("data"=>$data));
}else {
	echo "Session expired";
}

?>
