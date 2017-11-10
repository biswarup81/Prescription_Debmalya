<?php
include_once "../inc/datacon.php";
include_once '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
$PRESCRIPTION_ID = $_GET['prescription_id'];
$TYPE = $_GET['TYPE'];

$admin = new admin();
$admin->insertUpdatepastMedicalHistory($PRESCRIPTION_ID, $TYPE,$chamber_name, $doc_name);

$q15 = "SELECT b.type, b.ID FROM prescribed_past_med_history a, past_medical_history_master b
                WHERE a.clinical_impression_id = b.id
                AND a.prescription_id = '$PRESCRIPTION_ID' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id
								AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
$rsd1 = mysql_query($q15) or die(mysql_error());
echo '<table>';
       
        while($rs = mysql_fetch_array($rsd1)) {
            $type = $rs['type'];
            $cf_d = $rs['ID'];
            echo "<tr><td style='width: 180px;'>".$type."<a id='minusSymptoms' href='#' ></a></td>".
                "<td><a id='minusSymptoms' href='#' onclick='deletePastMedicalHistory($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        
echo '</table>';
}
?>
