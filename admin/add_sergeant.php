<?php
	include"../config/db.php";$msg = "";
	if(isset($_POST['submit']))
	{
		$name 			= $_POST['name'];		
		$password 		= $_POST['password'];
		//$password		= md5($password);
		
		$q = "INSERT INTO `user`(`user`, `pass`)
		VALUES('$name','$password')";
		
		$c = $connect->query($q);
		if($connect->error)
		{
			echo $connect->error;
		}else
		{
			$msg .= "<div class='bg-success text-light p-2'>Successfully added</div>";
		}
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	
	<title>Add Sergeant -<?php echo $app_name;?></title>
</head>
<body>
	<div class="bg-info p-2">
		<div class="container">		
				<span class="h4 text-light">
				<a class="text-decoration-none text-light" href="index.php"><?php echo $app_name;?></a>
				</span> 
		
			<span class="float-right">
			<a class="h5 text-light text-decoration-none" href="index.php" title="Go Home"> <i class="fas fa-home"></i></a> &nbsp; &nbsp;
			<a class="h5 text-light text-decoration-none" href="../config/logout.php" title="Logout"> <i class="fas fa-sign-out-alt"></i></a>
			</span>
		</div>
	</div>
	<br />
	<div class="container">
		<div class="shadow shadow-info p-4 w-75 mx-auto">
			<div class="h5">Sergeant Registration</div>
			<hr>
			<?php echo $msg;?>
			
			<br /><br />
			<form class="form-group" action="add_sergeant.php" method="POST">		
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">User name:</label>
					<div class="col-sm-10">
					<input type="text" name="name" class="form-control">
					</div>
				</div>			
				
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">password: </label>
					<div class="col-sm-10">
					<input type="password" name="password" class="form-control-plaintext">
					</div>
				</div>
			
					
					
				<input class="form-control btn-info" type="submit" value="Add" name="submit" />
									
			</form>
	</div>
</div>
		
</body>
</html>