<?php
include_once"../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
    
    $q = strtolower($_GET["term"]);
    if (!$q) return;
    $sql = "select * from allergy_master where ALLERGY_NAME LIKE '$q%'";
    /* $rsd = mysqli_query($con,$sql);
    while($rs = mysqli_fetch_array($rsd)) {
    	$cname = $rs['ALLERGY_NAME'];
    	echo "$cname\n";
    } */
    $result = mysql_query($sql)or die(mysql_error());
    
    $return_arr= array();
    
    while ($row = mysql_fetch_array($result))
    {
        $row_array['label'] = $row['ALLERGY_NAME'];
        $row_array['value'] = $row['ALLERGY_NAME'];
        
        array_push($return_arr,$row_array);
        
    }
    echo json_encode($return_arr);
}
?>
