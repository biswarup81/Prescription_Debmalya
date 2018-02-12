<?php
define("HOST", "localhost");
define("USER", "myepresc_pres");
define("PASSWORD", "KTHUsQI(xaCy");
define("DB_NAME", "myepresc_prescription");




$con = mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error);



function query($a){
	$r = mysql_query($a) or die(mysql_error());
	return $r;
}
?>