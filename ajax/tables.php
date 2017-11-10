<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){ 
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];	

	$mode = $_GET['MODE'];
	if($mode == 'DAILY'){
		$query = "SELECT COUNT( * ) as total, DATE_FORMAT(visit_date, '%M %d %Y') as that_day from visit
					WHERE chamber_id =  '$chamber_name'
					AND doc_id =  '$doc_name'
					group by that_day
					ORDER BY visit_date DESC ";
				
	} else if ($mode == 'MONTHLY'){
		$query = "SELECT COUNT( * ) as total, DATE_FORMAT(visit_date, '%M %Y') as that_day from visit
					WHERE chamber_id =  '$chamber_name'
					AND doc_id =  '$doc_name'
					group by that_day
					ORDER BY visit_date DESC ";
	} else if ($mode == 'ALL_PATIENT'){
		$query = "SELECT a.visit_id, b.patient_id, a.visited, b.patient_first_name,
		b.patient_last_name, b.patient_cell_num, DATE_FORMAT(a.VISIT_DATE,'%d-%M-%y') as visit_date
                        FROM visit a, patient b
                        WHERE a.patient_id = b.patient_id and a.doc_id=b.doc_id and a.chamber_id=b.chamber_id 
                        AND a.visited =  'yes' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' 
                        order by VISIT_DATE desc ";
	} 
	
	//echo $query;
	
	$result = mysql_query($query)or die(mysql_error());
	//$rowObject = mysql_fetch_assoc($result) ;
	
	$data = array();
	
	while ($row = mysql_fetch_array($result))
	{
		$data[] = $row;
	}
	echo json_encode(array("data"=>$data));
}
?>
