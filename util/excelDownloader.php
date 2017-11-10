<?php

function csvToExcelDownloadFromResult($result, $showColumnHeaders = true, $asFilename = 'data.csv') {
    setExcelContentType();
    setDownloadAsHeader($asFilename);
    return csvFileFromResult('php://output', $result, $showColumnHeaders);
}

function csvFileFromResult($filename, $result, $showColumnHeaders = true) {
    $fp = fopen($filename, 'w');
    $rc = csvFromResult($fp, $result, $showColumnHeaders);
    fclose($fp);
    return $rc;
}

function csvFromResult($stream, $result, $showColumnHeaders = true) {
    if($showColumnHeaders) {
        $columnHeaders = array();
        $nfields = mysql_num_fields($result);
        for($i = 0; $i < $nfields; $i++) {
            $field = mysql_fetch_field($result, $i);
            $columnHeaders[] = $field->name;
        }
        fputcsv($stream, $columnHeaders);
    }

    $nrows = 0;
    while($row = mysql_fetch_row($result)) {
        fputcsv($stream, $row);
        $nrows++;
    }

    return $nrows;
}

function setExcelContentType() {
    if(headers_sent())
        return false;

    header('Content-type: application/vnd.ms-excel');
    return true;
}

function setDownloadAsHeader($filename) {
    if(headers_sent())
        return false;

    header('Content-disposition: attachment; filename=' . $filename);
    return true;
}
require_once "../inc/config.php";
$ci = $_GET["CI"];
/*$mode = $_GET["MODE"];

if($mode == "PATIENTDATA"){
    
} */

$sql1 = "SELECT d.patient_first_name, d.patient_last_name, d.patient_name, d.patient_city, d.patient_dob, 
d.age, d.patient_cell_num, d.patient_address,  c.visit_date
FROM prescribed_cf a, prescription b, visit c, patient d, clinical_impression e
WHERE e.TYPE ='".$ci."'
and e.ID = a.clinical_impression_id
and a.prescription_id=b.prescription_id
and b.visit_id = c.visit_id
and c.patient_id = d.patient_id
ORDER BY d.patient_first_name ASC";


$result = mysql_query($sql1);
csvToExcelDownloadFromResult($result);

?>
