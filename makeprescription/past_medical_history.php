<div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Past Medical History</div>
<div class="inner" >

    <table>
        <tr><td id="CI" width="100%">

            <?php
                $q15 = "SELECT b.type, b.ID
                        FROM prescribed_cf a, clinical_impression b
                        WHERE a.clinical_impression_id = b.id
                        AND a.prescription_id = '$PRESCRIPTION_ID' and a.chamber_id='".$chamber_name."' AND a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id ";
                $rsd1 = mysql_query($q15) or die(mysql_error());

                while($rs = mysql_fetch_array($rsd1)) {
                    $type = $rs['type'];
                    $cf_d = $rs['ID'];
            ?>
                <table>      
                    <tr>
                        <td style="width: 180px;"><?php echo $type; ?><a id='minus7' href='#' ></a></td>
                    <td ><a id='minusMedicalHistory' href='#' 
                            onclick="deleteClinicalImpression('<?php echo $cf_d ; ?>',
                                '<?php echo $PRESCRIPTION_ID ; ?>')">[-]</a>
                    </td> 
                    </tr> 
                </table> 
            <?php    } ?>
            </td>
            </tr>
            <tr>
                <td width="100%"><input class="input_box_big" type='text' id='txtCI'/>

                </td>
                <td>
                    <a id='plusMedicalHistory' href='#' onclick="addClinicalImpression('<?php echo $PRESCRIPTION_ID ; ?>')">[+]</a>
                </td> 
            </tr>
    </table>
    </div>
