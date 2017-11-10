<?php

require_once "inc/config.php";
$q = $_GET["q"];
if (!$q) return;

$sql = "select distinct(investigation_type) from  investigation_master where investigation_type LIKE '$q%' and STATUS = 'ACTIVE'";
/* $rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['investigation_type'];
	echo "$cname\n";
} */
$result = mysql_query($sql)or die(mysql_error());
$rowObject = mysql_fetch_assoc($result) ;

$return_arr= array();

while ($row = mysql_fetch_array($result))
{
	$row_array['label'] = $row['investigation_type'];
	$row_array['value'] = $row['investigation_type'];
	
	array_push($return_arr,$row_array);
	
}
echo json_encode($return_arr);
?>
