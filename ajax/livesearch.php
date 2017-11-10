<?php
include_once "../inc/datacon.php";
include_once "../classes/admin_class.php";

if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$medicine_name=ucfirst($_GET["medicine_name"]);
$dose = $_GET['dose'];
$admin = new admin();
//$direction = $_GET['direction'];
//$timing = $_GET['timing'];
$patient_id = $_GET['patient_id'];
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$VISIT_ID = $_GET['VISIT_ID'];
$precribed_medicine_id=$_GET['prescribe_medicine_id'];

$dose1 = $_GET['dose1'];
$dose2 = $_GET['dose2'];
$dose3 = $_GET['dose3'];

if($dose1 != ""){
	//echo "inside";
	$admin->insertintoDoseMasterTable($dose1, $chamber_name, $doc_name);
}

if($dose2 != ""){
	$admin->insertintoDoseMasterTable($dose2, $chamber_name, $doc_name);
}

if($dose3 != ""){
	$admin->insertintoDoseMasterTable($dose3, $chamber_name, $doc_name);
}
//Inser dose in dose_details_master table
$max_medicine_id = $admin->getMaxMedicineID($chamber_name, $doc_name);
$sql0 = "select * from medicine_master a where a.MEDICINE_NAME = '$medicine_name' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
//echo $sql0;
$result0 = mysql_query($sql0) or die(mysql_error());
if(mysql_num_rows($result0) == 0){
	$query = "insert into medicine_master(MEDICINE_ID, MEDICINE_NAME,  MEDICINE_ENTRY_DATE_TIME,  chamber_id, doc_id)
	values('$max_medicine_id','$medicine_name', NOW(), '$chamber_name','$doc_name')";
	//echo $query;
	$precribed_medicine_id = $max_medicine_id;
	mysql_query($query) or die(mysql_error());
}

//$prescribed_medicine_max_id = $admin->getMaxPrescribedMedicineID($chamber_name, $doc_name);
$sql3 = "insert into precribed_medicine (MEDICINE_ID, PRESCRIPTION_ID, MEDICINE_NAME, MEDICINE_DOSE,  chamber_id, doc_id) 
values('$precribed_medicine_id','$PRESCRIPTION_ID','$medicine_name', '$dose', '$chamber_name','$doc_name')";
//echo $sql3;
mysql_query($sql3) or die(mysql_error());


$sql2 = "select * from precribed_medicine a where a.PRESCRIPTION_ID = '$PRESCRIPTION_ID' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
$result = mysql_query($sql2) or die(mysql_error());

echo "<table id='table-3'>";
while($d = mysql_fetch_object($result)){
	echo "<tr>
                <td>
                    <img src='images/stock_list_bullet.png'/>&nbsp;<strong>".$d->MEDICINE_NAME."</strong>&nbsp;<img src='images/arrow-right.png' />
                                        <i>".$d->MEDICINE_DOSE."</i></td>";
       
	//echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";
        
	echo "<td align='center' width='90'>
          <input class='btn btn-warning' id='remove_$d->MEDICINE_ID' href='#' onclick='del($d->MEDICINE_ID ,$PRESCRIPTION_ID )' value='Remove'> </td> ";
	echo "</tr>";
}

echo "</table'>";
/*
//echo $medicine_name."+".$dose."+".$direction."+".$timing."+".$patient_id;
if(mysql_affected_rows() > 0){
    echo "<medicine><flag>SUCCESS</flag><name>".$medicine_name."</name><dose>".$dose."</dose><direction>".$direction."</direction><timing>".$timing."</timing></medicine>";
} else{
    echo "<medicine><flag>FAIL</flag></medicine>";
}*/

}else {
	echo "Session expired";
}
?>
