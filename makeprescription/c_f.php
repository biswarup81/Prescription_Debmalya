<div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;C/F </div>
    <div class="inner">
        <div id="CF">

                    <?php
                            $q15 = "select a.VALUE, b.NAME, a.ID from
                                patient_health_details a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$visit_id' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id and
            					a.chamber_id='".$chamber_name."' AND a.doc_id='".$doc_name."'";
                            $rsd1 = mysql_query($q15);

                            while($rs = mysql_fetch_array($rsd1)) {
                                    $name = $rs['NAME'];
                                    $value = $rs['VALUE'];
                                    $id = $rs['ID'];
                    ?>
                    <div class="row">
                            <div class="col-md-6"><?php echo $name; ?></div> 
                            <div class="col-md-4"><input type="text" id="CF_<?php echo $id ?>"  class="form-control" value="<?php echo $value; ?>" /></div> 
                            <div class="col-md-2" ><input type="button" class="update_row" class="form-control" onclick="updateDeleteCF('<?php echo $id ; ?>',
                                            '<?php echo $visit_id ; ?>','UPDATE')"/>
                            </div> 
                    </div>
            <?php    } ?>
            </div>
            <div class="row">
                                <div class="col-md-6">
                                        <input type='text' class="form-control" id='txtCFName'/>
                                </div>
                                <div class="col-md-4">
                                        <input type='text' class="form-control" id='txtCFValue'/>
                                </div>	
                                <div class="col-md-3">
                                    <input type='button' class="delete_row" onclick="addCF('<?php echo $visit_id ; ?>')"/>
                                </div>
             </div>



    </div>