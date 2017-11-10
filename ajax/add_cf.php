<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){ 
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
	
$cfname = $_GET['cfname'];
$cfvalue = str_replace("PLUS","+",$_GET['cfvalue']);
$visit_id = $_GET['visit_id'];
//GET ID of the TYPE
$admin = new admin();


if($cfname !=''){
   
   $admin->insertUpdateCF($cfname, $cfvalue, $visit_id, $chamber_name, $doc_name);    
}
$q15 = "select a.VALUE, b.NAME, a.ID from
                                patient_health_details a ,patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$visit_id' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id
								AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' ";


$rsd1 = mysql_query($q15);
while($rs = mysql_fetch_array($rsd1)) {
    $name = $rs['NAME'];
    $value = $rs['VALUE'];
    $id = $rs['ID'];

    echo"<table>";

    echo"<tr>";

    echo "<td width='100%' >$name</td>";
    echo "<td width='100%' ><input type='text'  class='input_box_small' 
        id='CF_".$id."' style='width: 40px;' value='".$rs['VALUE']."' />
            <a id='minus7' href='#' ></a></td>";

    ?>

    <td><input type="button" class="update_row" onclick="updateDeleteCF(
        '<?php echo $id ; ?>','<?php echo $visit_id; ?>','UPDATE')"/>
    </td>
    <?php    
    echo"</tr>";

    echo"</table>";

}
}
?>
