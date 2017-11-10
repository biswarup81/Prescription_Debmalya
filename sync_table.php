<?php
// database connection.
include_once "./inc/datacon.php"; 

// server url.
$url = "http://myeprescription.in/synchronized.php";

$table_array = array('allergy_master','clinical_impression','dose_details_master','dose_direction','dose_timing_master','investigation_master','lmp','medicine_master','past_medical_history_master','patient','patient_health_details','patient_health_details_by_receptionist','patient_health_details_master','patient_investigation','precribed_medicine','prescribed_allergy','prescribed_cf','prescribed_investigation','prescribed_past_med_history','prescribed_social_history','prescription','reception_master','social_history_master','visit');

foreach($table_array as $table){
    
    $sql = "SELECT * FROM $table WHERE isSync = '0'";
    $resource = mysql_query($sql) or die(mysql_error());
    
    echo "<pre>";
    
    $data = array();
	$no = mysql_num_rows($resource);
    if ( $no > 0) {
    while($result = mysql_fetch_assoc($resource)){
        //print_r($result);
        array_push($data, $result);
    }
    
    $data = json_encode($data);
    //echo $data;
     $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"data=$data&table=$table");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $server_output = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "SERVER OUTPUT ->".$server_output;
    /*if ($server_output == "OK") {
     echo "Hello";
     }else{
     echo "Failed";
     }*/
    
    $sql_update = "UPDATE $table SET isSync = '1' WHERE auto_id IN ($server_output)";
    echo $sql_update;
    mysql_query($sql_update) or die(mysql_error());
    
    echo $sql_update."<br>"; 
	} else{
		echo "No update in table name = ".$table;
	}
}