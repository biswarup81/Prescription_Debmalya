<div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Allergy</div>
<div class="inner1">

    <table>
        <tr><td id="ALLERGY" width="100%">

            <?php
                $q15 = "SELECT b.ALLERGY_NAME, b.ALLERGY_ID
                        FROM prescribed_allergy a, allergy_master b
                        WHERE a.ALLERGY_ID = b.ALLERGY_ID
                        AND a.PRESCRIPTION_ID = '$PRESCRIPTION_ID' and a.chamber_id='".$chamber_name."' AND a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id";
                $rsd1 = mysql_query($q15) or die(mysql_error());

                while($rs = mysql_fetch_array($rsd1)) {
                    $type = $rs['ALLERGY_NAME'];
                    $allergy_name = $rs['ALLERGY_ID'];
            ?>
                <table>      
                    <tr>
                        <td style="width: 180px;"><?php echo $type; ?><a id='minus7' href='#' ></a></td>
                    <td ><a id='minusAllergy' href='#' 
                            onclick="deleteAllergy('<?php echo $allergy_name ; ?>',
                                '<?php echo $PRESCRIPTION_ID ; ?>')">[-]</a>
                    </td> 
                    </tr> 
                </table> 
            <?php    } ?>
            </td>
            </tr>
            <tr>
                <td width="100%"><input class="input_box" type='text' id='txtAllergy'/>

                </td>
                <td>
                    <a id='plusAllergy' href='#' onclick="addAllergy('<?php echo $PRESCRIPTION_ID ; ?>')">[+]</a>
                </td> 
            </tr>
    </table>
    </div>