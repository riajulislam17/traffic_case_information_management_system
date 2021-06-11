<?php
	$alert = "";
	$msg = "";

	if(isset($_POST['submit']))
	{
		
			$servername = "localhost";
			$username 	= $_POST['db_user'];
			$password	= $_POST['db_pass'];
			$db_name	= $_POST['db_name'];
			
		// Create connection
		$conn = new mysqli($servername, $username, $password);		
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}	
		
		//check database available or not
		$check = "SHOW DATABASES LIKE $db_name";
		
		
		
			
				

				// Create database
				$sql = "CREATE DATABASE $db_name";
				if ($conn->query($sql) === TRUE) {
					$msg .= "<div class='bg-success text-light p-3'>Database created successfully, Redirecting... Now <a href='create_table.php'><b>create </b></a> table  </div>
					<script>
					setTimeout(function(){ 
						window.location.href = 'create_table.php';
					 }, 1500);
					</script>
					";
				} else {
					$alert .= "<div class='bg-danger text-light p-3'>Error creating database: " . $conn->error ." , Now <a href='create_table.php'><b>create </b></a> table </div>";
				}
			
		
		
	

		$file = '../config/db.php';
	 	file_put_contents($file,str_replace('database',$db_name,file_get_contents($file)));
	}


?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/js/bootstrap.js" />
	
	<title>Setup DataBase</title>
</head>
<body>
	
	<form action="setup.php" method="POST">
		<div class="mx-auto w-25" >
		<br />
		<br />
		<p class="bg-info text-light p-2">There is no database created for this project. Please Create Database and remember it</p>
		<br />
		<br />
			<?php echo $alert;?>
			<?php echo $msg;?>
		<div class="form-row">
			<div class="col-12"><br /><br />
				<label class="h4" for="db_user">Database Username</label>
				<input type="text" class="form-control" name="db_user" value="root"/>
				<small class="text-info">Generally Database User is 'root'. Leave as it Default</small>
			</div>	
			<br /><br />
			<div class="col-12"><br /><br />
				<label  class="h4" for="db_pass">Database Password</label>
				<input type="text" class="form-control" name="db_pass" value=""/> 
				<small class="text-info">Generally Database User is (empty)''. Leave as it Blank</small>
			</div>	
			<div class="col-12"><br /><br />
				<label  class="h4" for="db_name">Database Name:</label>
				<input type="text" class="form-control" name="db_name" required/> 
				<small class="text-info">Enter Database name what you want to create. </small>
			</div>
			<div class="col-12">	<br /><br />
				<input type="submit" class="form-control btn-success" value="Create database" name="submit"/>
			</div>	
		</div>	
		</div>
		
	</form>
</body>
</html>