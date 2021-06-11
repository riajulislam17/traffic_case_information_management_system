<?php
	include "../config/db.php";
	$msg="";
	if(isset($_POST['submit']))
	{
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		
		$q= "Insert into admin(`user`,`pass`) VALUES('$user','$pass')";
		$s= $connect->query($q);
		if($connect->error)
		{
			 $msg.="<div class='bg-danger text-light p-2'>$connect->error</div>";
		}
		else{
			 $msg.="<div class='bg-success text-light p-2'>Registation Successful <a href='login.php'>Login</a></div>";
		}
		
		
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/js/bootstrap.js" />
	<title>Registation -<?php echo $app_name;?></title>
</head>
<body>
	<div class="bg-primary h2 text-light p-2"> <div class="container"> <?php echo $app_name;?> </div></div>
		<br />
		<br />
		
	<div class="container">
	<div class="w-50 p-5 shadow bg-white rounded">

	<?php echo $msg;?>
		<h4> Admin Registation </h4>
		<hr />
	<form  action="register.php" method="POST">
		<div class="col-12">
			<label for="user">Enter Username</label>
			<input class="form-control" type="text" name="user"/><br />
		</div>
		<div class="col-12">
			<label for="user">Enter Password</label>
			<input class="form-control" type="password" name="pass"/><br />
		</div>
		<div class="col-12">
			<label for="user">Enter Password Again</label>
			<input class="form-control" type="password" name="repass"/><br />
		</div>
		<div class="col-12"> 
			<p class="text-info">
				Already Register? <a href="login.php">Login</a>
			</p>
			<input class="form-control btn-success" type="submit" value="Create Account" name="submit"/> <br />
		</div>
	</form>
	</div>
	
</body>
</html>