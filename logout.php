<?php 
ob_start();
session_start();
$_SESSION=array();
session_destroy();
/* header("location:index_login.php"); */
echo "<script>location.href='index_login.php'</script>";
exit;
?>