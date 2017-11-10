<?php 

if(isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])) {
    if($_SESSION['doc_name'] == 'dsanyal'){
        include_once ("doc_header_dsanyal.php") ;
    } else {
     include_once ("doc_header.php") ;
    }
     include_once ("prescription_main_menu.php");
     }?>
 
<!--END of header-->