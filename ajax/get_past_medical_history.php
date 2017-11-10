<?php
include_once "../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
    $q = strtolower($_GET["term"]);

    if (!$q) return;
    
    $sql = "select a.TYPE from past_medical_history_master a where a.TYPE LIKE '$q%' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' and STATUS='ACTIVE'";
    $result = mysql_query($sql)or die(mysql_error());
    
    $return_arr= array();
    
    while ($row = mysql_fetch_array($result))
    {
        $row_array['label'] = $row['TYPE'];
        $row_array['value'] = $row['TYPE'];
        
        array_push($return_arr,$row_array);
        
    }
    echo json_encode($return_arr);

} else {
    $return_arr= array();
    $row_array['label'] = "Session Expired";
    $row_array['value'] = "Session expired";
    
    array_push($return_arr,$row_array);
    echo json_encode($return_arr);
}
?>
