<script>
			function myFunction(paths) {
			  setTimeout(function(){				 
				  window.location.href = paths;
				  
				  }, 1000);
			}
			</script>
<?php
	include "db.php";
	$msg="";
		
		if(isset($_COOKIE['admin']))
		{
			$msg .="<div class='bg-success text-light p-2'>You already Login In</div>";
			echo $redirects = "
			<script>
			var a = '../admin/';
				myFunction(a);
			</script>";
		}
		if(isset($_COOKIE['sergeant']))
		{
		echo	$redirects = "
			<script>
			var a = '../sergeant/search.php';
				myFunction(a);
			</script>";
			$msg .="<div class='bg-success text-light p-2'>You already Login In</div>";
			
		}
		if(isset($_COOKIE['driver']))
		{
			$msg .="<div class='bg-success text-light p-2'>You already Login In</div>";
		echo 	$redirects = "<script>
			var a = '../driver/profile.php';
				myFunction(a);
			</script>";
			
		}
		
	
	
	
	if(isset($_POST['submit']))
	{
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$passe = md5($pass);
		$type = $_POST['type'];
		if($type == 1){ // 1 means admin
			
			$q= "select * from admin where user like '%".$user."%' and pass like '%".$pass."%'";
			$n = mysqli_num_rows(mysqli_query($connect,$q));
			$array = mysqli_fetch_assoc(mysqli_query($connect,$q));
			$id = $array['id'];
			$info= "admin";
			$redirects = "
			<script>
			var a = '../admin/';
				myFunction(a);
			</script>";
		}
		if($type == 2){ // 2 means surgets 
			
			$q= "select * from user where user like '%".$user."%' and pass like '%".$pass."%'";
			$n = mysqli_num_rows(mysqli_query($connect,$q));
			$array = mysqli_fetch_assoc(mysqli_query($connect,$q));
			$id = $array['id'];
			$info= "sergeant";
			$redirects = "
			<script>
			var a = '../sergeant/search.php';
				myFunction(a);
			</script>";
			
		}
		if($type == 3){ // 3 means driver
			
			$q= "select * from driver_information where phone_number like '%".$user."%' and password like '%".$passe."%'";
			$n = mysqli_num_rows(mysqli_query($connect,$q));
			$array = mysqli_fetch_assoc(mysqli_query($connect,$q));
			$id = $array['driver_id'];
			$info="driver";
			$id_value=$id;
			$redirects = "<script>
			var a = '../driver/profile.php';
				myFunction(a);
			</script>";
			
			
		}
		
		
		
		
		if($n>0)
		{
			setcookie($info,$user,time() + (86400), "/");
			setcookie("id",$id,time() + (86400), "/");
			echo $redirects;	
			$msg.="<div class='bg-success text-light p-2'>Login Successful. Just 1s Redirect to home page <a href='login.php'>Login</a></div><br />";			
		}
		else{
			$msg.="<div class='bg-danger text-light p-2'>Sorry, Login Failed.</div><br />";
		}
		$s= $connect->query($q);
		
		if($connect->error)
		{
			 $msg.="<div class='bg-danger text-light p-2'>$connect->error</div> <br />";
		}
		else{
			 
		}
		
		
	}

		
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/js/bootstrap.js" />
	<title>Login -<?php echo $app_name;?></title>
</head>
<body>
	<div class="bg-primary h2 text-light p-2 center"><div class="container"><?php echo $app_name;?></div></div>
	<div class="container">	
	<br />
		<div class="w-50 p-5 shadow p-3 mb-5 bg-white rounded">
			<div class="h4">Login Panel</div>
			<hr />
			<form  action="login.php" method="POST">
					<br /><?php echo $msg;?>				
					<label for="user">Username / Phone (Driver)</label>
					<input class="form-control" type="text" name="user"/>
					<br />
					<label for="user">Password</label>
					<input class="form-control" type="password" name="pass"/>
					<div class="radio">
					  <label><input type="radio" name="type" value="1" checked>As Admin</label>
					&nbsp; &nbsp; 
					  <label><input type="radio" name="type" value="2">As Sergeant</label>
					 &nbsp; &nbsp; 
					  <label><input type="radio" name="type" value="3">As Driver</label>
					</div>				
					<br />
					<p class="text-info">Not registerd? <a href="register.php">Go here</a></p>		
					<br />
				<input class="form-control btn-success" type="submit" value="Login" name="submit"/>
			
			</form>
		</div>
	</div>

	
</body>
</html>