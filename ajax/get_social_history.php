<?php
include_once "../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
    $q = strtolower($_GET["term"]);

    $sql = "select * from social_history_master where TYPE LIKE '$q%'";
    $result = mysql_query($sql)or die(mysql_error());
    $return_arr= array();
    
    while ($row = mysql_fetch_array($result))
    {
        $row_array['label'] = $row['TYPE'];
        $row_array['value'] = $row['TYPE'];
        
        array_push($return_arr,$row_array);
        
    }
    echo json_encode($return_arr);
}
?>
