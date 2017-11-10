<?php if(isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])) {
	include_once "./inc/datacon.php";
	include_once 'classes/prescription_header.php';
	
	$chamber_id = $_SESSION['chamber_name'];
	$doc_name = $_SESSION['doc_name'];
	$header = new Header($doc_name,$chamber_id);
		      
?>	    
	
<div class="row">
        <div class="col-md-8"> Date : <?php echo date("d/m/y") ?></div>
        <div class="col-md-4"><div class="pull-right"><b>(<?php echo $header->doctor_full_name; ?>) </b><br>Reg. No. # <?php echo $header->doc_reg_num;; ?></div></div>
</div>	
<footer class="footer">
      
      <div class="alert alert-info" role="alert">
        <strong><?php echo $header->chamber_footer; ?></strong>
      </div>
      
    </footer>
<?php }?>