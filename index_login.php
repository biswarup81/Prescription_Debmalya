<?php
include_once "./inc/datacon.php";
include_once './inc/header.php';;
$err = false;
$print = "";
if(isset($_REQUEST['action'])){
    $action=$_REQUEST['action'];
    if($action=='login'){


        $uname=stripslashes(trim($_POST['user_name']));
        $pass=stripslashes($_POST['password']);

        $sql = "select * from user where user_name = '$uname' and user_password = '".md5($pass)."'";
        $r = mysql_query($sql) or die(mysql_error());
        $d = mysql_fetch_object($r) ;

        
        if(mysql_num_rows($r) > 0){
            $user_role = $d->role;
            $user_name = $d->user_name;
            $user_id = $d->user_id;
            
            $_SESSION['user_type'] = $user_role;
            $_SESSION['user_id'] = $user_id;
            
            //$_SESSION['user_name'] = $user_name;
           
            
            if($user_role== 'DOCTOR'){
                $_SESSION['user_name'] = 1;
                $_SESSION['logged_in_user_id'] = 1;
                    echo "<script>location.href='select_chamber.php'</script>";
            } else if ($user_role== 'RECEPTIONIST' || $user_role== 'CHEMIST'){
                $_SESSION['user_name'] = 'mayukh';
                $_SESSION['logged_in_user_id'] = 1;
                    echo "<script>location.href='select_chamber.php'</script>";
            } else {
            	$msg = "You are not authorize to perform any operation !!";
            }
        } else{
        	$err = true;
			$msg = "Enter a valid user id and/or password.Try Again";
        }
    }
} 
?>

  <body>

    <div class="container">
		<div class="row">
		  <?php if($err){?>
		  <div class="alert alert-danger" role="alert"> 
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
			<span class="sr-only">Error:</span> <?php echo $msg;?>
		 </div>
		  <?php }?>
	  </div>
      <form class="form-signin" action="index_login.php?action=login" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="user_name" class="sr-only">Login ID</label>
        
        <input type="text" name="user_name" class="form-control" placeholder="Enter user id" required autofocus />
        <label for="inputPassword" class="sr-only">Password</label>
       
        <input type="password" name="password" class="form-control" placeholder="Enter password" required />
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>

        <button name="login" value="Login" class="btn btn-lg btn-primary btn-block" type="submit" >Sign in</button>
      </form>

    </div> <!-- /container -->
    <?php include_once './inc/footer.php';?>
  </body>
</html>
