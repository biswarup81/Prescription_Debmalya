<?php
include_once "../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$ci_id = $_GET['ID'];
$admin= new admin();

$admin->deleteSocialHistory($PRESCRIPTION_ID,$ci_id,$con,$chamber_name,$doc_name);

//echo $result;


$q15 = "SELECT b.TYPE, b.ID FROM prescribed_social_history a, social_history_master b
                WHERE a.social_history_id = b.ID
                AND a.prescription_id = '$PRESCRIPTION_ID' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
//echo $q15 ; 
        $rsd1 = mysql_query($q15) or die (mysql_error());
echo '<table>';
        if(mysql_num_rows($rsd1) > 0){
        while($rs = mysql_fetch_array($rsd1)) {
            $type = $rs['TYPE'];
            $cf_d = $rs['ID'];
            echo "<tr><td style='width: 180px;'>".$type."<a id='minusSocialHistory' href='#' ></a></td>".
                "<td><a id='minusSocialHistory' href='#' onclick='deleteSocialHistory($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        } 
echo '</table>';
}
?>
