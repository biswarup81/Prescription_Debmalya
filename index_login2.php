
<?php
include_once "datacon.php";

$err = false;
$print = "";
if(isset($_REQUEST['action'])){
    $action=$_REQUEST['action'];
    if($action=='login'){


        $uname=stripslashes(trim($_POST['user_name']));
        $pass=stripslashes($_POST['password']);

        $sql = "select * from user where user_name = '$uname' and user_password = '$pass'";
        $r = mysql_query($sql) or die(mysql_error());
        $d = mysql_fetch_object($r) ;

        
        if(mysql_num_rows($r) > 0){
            $user_type = $d->label;
            $user_name = $d->user_name;
            $user_id = $d->user_id;
            
            $_SESSION['user_type'] = $user_type;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            
            if($user_type == 'DOCTOR'){
                    echo "<script>location.href='select_chamber1.php'</script>";
            } else if ($user_type == 'RECEPTIONIST'){
                    echo "<script>location.href='select_chamber1.php'</script>";
            }
        } else{
        $print="<font color='red'>Invalid User Name or Password</font>";

        }
    }
} 
?>
<?php include "header.html"; ?>
<body>
    
    <div id="wrapper">
            
            <div class="container" align="center">
        
            
<!--BEGIN header-->
<?php if(isset($_SESSION['chamber_name'])) {
    include("banner.php");
		 }?>
    <!--END of header-->

        <div class="worning" style="text-align: center;"><?php echo $print;?></div>
   <div class="login_wrapper" align="center">
   		<div class="login_info"><p>Login to Myeprescription</div>
   		<div class="login">
    		<form action="index_login.php?action=login" method="post">
    			<table width="350" border="0" cellspacing="4" cellpadding="5" align="center">
    			  <tr>
    				<td>User Name :</td>
    				<td><input type="text" name="user_name" class="text" /></td>
    			  </tr>
    			  <tr>
    				<td>Password</td>
    				<td><input type="password" name="password" class="text" /></td>
    			  </tr>
    			  <tr>
    				<td>&nbsp;</td>
    				<td><input type="submit" name="login" value="Login"  
                                               style="border:solid 1px #CCCCCC; padding:3px; cursor:pointer;"/></td>
    			  </tr>
    			</table>
    		</form>
		</div> 
   </div>
       
		<?php include("footer.php"); ?>    
    </div>
</div>
            
            
            
            

</body>
</html>
<?php ob_flush(); ?>
