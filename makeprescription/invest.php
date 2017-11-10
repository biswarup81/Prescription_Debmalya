
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#tab1">Diabetes</a></li>
  <li><a data-toggle="tab" href="#tab2">Thyroid</a></li>
  <li><a data-toggle="tab" href="#tab3">Hypertension</a></li>
  <li><a data-toggle="tab" href="#tab4">PCOS/Hirsutism</a></li>
  <li><a data-toggle="tab" href="#tab5">Short Stature</a></li>
  <li><a data-toggle="tab" href="#tab6">Hypogonadism</a></li>
  <li><a data-toggle="tab" href="#tab7">Infertility</a></li>
  <li><a data-toggle="tab" href="#tab8">Precocity</a></li>
  <li><a data-toggle="tab" href="#tab9">Achenol</a></li>
  <li><a data-toggle="tab" href="#tab10">Bone</a></li>
  <li><a data-toggle="tab" href="#tab11">Lung GI</a></li>
  <li><a data-toggle="tab" href="#tab12">Sexual</a></li>
  <li><a data-toggle="tab" href="#tab13">Others</a></li>
</ul>

<div class="tab-content">
  <div id="tab1" class="tab-pane fade in active">
    <div id="tab111" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE1' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>  
     <div class="row">
				  <div class="col-md-4"> <input type="text" class="form-control" id="invest1" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE1')" value="ADD" /></div>
				</div> 
  </div>
  <div id="tab2" class="tab-pane fade">
    <div id="tab112" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE2' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

               <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest2" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE2')" value="ADD" /></div>
				</div> 
  </div>
  <div id="tab3" class="tab-pane fade">
    <div id="tab113" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE3' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

                <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest3" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE3')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab4" class="tab-pane fade">
    <div id="tab114" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE4' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

               <div class="row">
				  <div class="col-md-4"> <input type="text"  id="invest4" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE4')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab5" class="tab-pane fade">
    <div id="tab115" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE5' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

               <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest5" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE5')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab6" class="tab-pane fade">
    <div id="tab116" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE6' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

                <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest6" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE6')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab7" class="tab-pane fade">
    <div id="tab117" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE7' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

                <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest7" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE7')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab8" class="tab-pane fade">
    <div id="tab118" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE8' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

                <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest8" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE8')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab9" class="tab-pane fade">
    <div id="tab119" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE9' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

               <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest9" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE9')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab10" class="tab-pane fade">
    <div id="tab1110" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE10' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

                <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest10" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE10')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab11" class="tab-pane fade">
     <div id="tab1111" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE11' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

                <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest11" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE11')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab12" class="tab-pane fade">
    <div id="tab1112" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE12' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      

                <div class="row">
				  <div class="col-md-4"> <input type="text" id="invest12" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE12')" value="ADD" /></div>
				</div>
  </div>
  <div id="tab13" class="tab-pane fade">
    <div id="tab1113" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE13' and STATUS = 'ACTIVE' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
                    $result = mysql_query($query);
                        while($rs = mysql_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<label class='checkbox-inline'>
                                <input type='checkbox' name='inv[]'  value='".$inv_id."'> ".$cname."</label>";
                        }
                    ?>
                </div>      
				<div class="row">
				  <div class="col-md-4"> <input type="text" id="invest13" class="form-control" value="" placeholder="Enter investigation name"/></div>
				  <div class="col-md-8"><input type="button" class="btn btn-success" name="ADD" onclick="return addInvestigation('TYPE13')" value="ADD" /></div>
				</div>
                
  </div>
</div>
