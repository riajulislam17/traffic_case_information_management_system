<?php
	include"../config/db.php";$msg = "";
	if(isset($_POST['submit']))
	{
		$name 			= $_POST['name'];
		$phone 			= $_POST['phone'];
		$license_number = $_POST['license'];
		$address 		= $_POST['address'];
		$case_count 	= 0;		
		$rating 		= 5;
		$password 		= $_POST['password'];
		$password		= md5($password);
		
		$q = "insert into driver_information
		(`name`,`phone_number`,`license_number`,`address`,`case_count`,`rating`,`password`)
		values('$name','$phone','$license_number','$address','$case_count','$rating','$password')";
		
		$c = $connect->query($q);
		if($connect->error)
		{
			echo $connect->error;
		}else
		{
			$msg .= "<div class='bg-success text-light p-2'>Successfully added</div> <br>";
		}
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	
	<title>Add Driver -	<?php echo $app_name;?></title>
</head>
<body>	
	<div class="bg-info p-2">
		<div class="container">		
			<span class="h4 text-light">
					<a class="text-decoration-none text-light" href="index.php">
						<?php echo $app_name;?>
					</a>
			</span> 
		
			<span class="float-right">
				<a class="h5 text-light text-decoration-none" href="index.php" title="Go Home"> <i class="fas fa-home"></i></a> &nbsp; &nbsp;
				<a class="h5 text-light text-decoration-none" href="../config/logout.php" title="Logout"> <i class="fas fa-sign-out-alt"></i></a>
			</span>
		</div>
	</div>
	<br />



	<div class="container">
		<div class="mx-auto w-75 shadow shadow-info p-5">
			<div class="h5">Driver Registration</div>
			<hr>
			<?php echo $msg;?>
		<form class="form-group" action="add_driver.php" method="POST">		
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Driver name:</label>
				<div class="col-sm-10">
				  <input type="text" name="name" class="form-control">
				</div>
			</div> <br>
			
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Phone:</label>
				<div class="col-sm-10">
				  <input type="number" name="phone" class="form-control">
				</div>
			</div><br>
			
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">License: </label>
				<div class="col-sm-10">
				  <input type="text" name="license" class="form-control">
				</div>
			</div><br>
			
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Address: </label>
				<div class="col-sm-10">
				  <input type="text" name="address" class="form-control">
				</div>
			</div><br>
			
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Password: </label>
				<div class="col-sm-10">
				  <input type="password" name="password" class="form-control-plaintext">
				</div>
			</div><br>
		
				
				
			<input class="form-control btn-info" type="submit" value="Add" name="submit" />
								
		</form>
		</div>
	</div>


	
</body>
</html>