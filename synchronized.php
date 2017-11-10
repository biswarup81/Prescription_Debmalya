<?php
error_reporting(E_ALL);
include('inc/datacon_sync_dsanyal.php');

$data  = $_POST['data'];
$table = $_POST['table'];

$data = json_decode($data);
//print_r($data);

//unset($data['is_shync']);

$inserted_ids = array();

foreach($data as $row){

	$row = (array) $row;
	$id = $row['auto_id'];
	unset($row['isSync']);
	unset($row['auto_id']);
	$data_string = implode("','",(array) $row);

	$fields = array_keys($row);
	$fields_str = implode(',', $fields);

	$sql = "INSERT INTO $table ($fields_str) VALUES ('$data_string')";

    //echo $sql."<br>";

	if(mysql_query($sql)){
		$inserted_ids[] = $id;
	}
}

echo implode(',',$inserted_ids);


