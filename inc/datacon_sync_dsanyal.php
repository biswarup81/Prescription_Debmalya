<?php

/* script to connect fo Mandir Database and pick up neccesary Information to display on screen */
/* declare some relevant variables */
$hostname = "localhost";
$username = "myepresc_doctor";
$passwordsc = "welcome@123";
$dbName = "myepresc_desanyal";

$con = mysql_connect($hostname,$username,$passwordsc);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbName, $con);

?>