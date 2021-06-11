<script type="text/javascript">
			function re()
			{
				setTimeout(function(){
					var url = window.location.href;
				console.log(url);
				window.location.href= url;
				}, 2500);
				
			}
		</script>
<?php
	include"../config/db.php";
	$msg="";
	$view="";
	if(!isset($_COOKIE['sergeant']))
	{
		header("location:../config/login.php");
	}
	if(isset($_GET['driver_id']))
	{
		$driver_id= $_GET['driver_id'];
		}
	else{
		header("location:search.php");
	}
		$driver_id= $_GET['driver_id'];
		$query = "select * from driver_information where driver_id=$driver_id";
		$arraydata = mysqli_fetch_assoc(mysqli_query($connect,$query));
		if($arraydata['rating']>0){$rating=$arraydata['rating'];}else{$rating= $arraydata['rating']." &nbsp;<span class='badge badge-danger'>suspended</span>";}
		$view= "<table class='table'>
		<tr>
			<td>Id:</td>		<td>".$arraydata['driver_id']."</td>
		</tr><tr>	
			<td>Name:</td>		<td>".$arraydata['name']."</td>
		</tr><tr>		
			<td>Phone:</td>		<td>".$arraydata['phone_number']."</td>
		</tr><tr>		
			<td>License:</td>		<td>".$arraydata['license_number']."</td>
		</tr><tr>			
			<td>Address:</td>		<td>".$arraydata['address']."</td>
		</tr><tr>		
			<td>Total Case:</td>		<td>".$arraydata['case_count']."</td>
		</tr><tr>		
			<td>Rating:</td>		<td>". $rating ."</td>
		</tr><tr>		
			<td>Registration time:</td>		<td>".$arraydata['time']."</td>
		</tr>
		</table>";
	
	
	if(isset($_POST['submit']))
	{
		$driver_id= $_GET['driver_id'];
		$case_type = $_POST['case_type'];
		$fee = $_POST['fee'];	
		$q = "INSERT INTO `case_list`(`driver_id`, `case_type`, `fine_amout`) VALUES('$driver_id','$case_type','$fee')";
		$new_case_count = $arraydata['case_count'] + 1;
		$new_rating = $arraydata['rating'] - 1;
		$update_query= "UPDATE `driver_information` SET `case_count` = '$new_case_count', `rating`='$new_rating' WHERE `driver_information`.`driver_id` = $driver_id;";
		$u = $connect->query($update_query);
		$c = $connect->query($q);
		if($connect->error)
		{
			$msg .= $connect->error;
		}else
		{
			$msg .= "<div class='bg-success text-light p-2'>Successfully added</div>";
		}
		echo"<script>
			re(); </script>";
	}
	
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	
	<title>Add Case -Database Project</title>
</head>
<body>
	<div class="bg-info p-2">
			<div class="container">		
					<span class="h4 text-light">
					<a class="text-decoration-none text-light" href=""><?php echo $app_name;?></a>
					</span> 
			
				<span class="float-right text-light">
				Welcome (<?php echo $_COOKIE['sergeant'];?>) &nbsp;
				<a class="text-light" title="Go Home" href="search.php"><i class="fas fa-home"></i></a> &nbsp;
				<a class="h5 text-light text-decoration-none" href="../config/logout.php" title="Logout"> <i class="fas fa-sign-out-alt"></i></a>
				</span>
			</div>
		</div>
		<br>
	<div class="mx-auto">
		<div class="container">		
			<div class="w-75 mx-auto shadow shadow-info p-5">
				<div class="h5">
					New Case
				</div>
											
				<?php echo $msg;?>
				<?php echo $view;?>
					<form class="form-group" action="add.php?driver_id=<?php echo $driver_id;?>" method="POST">
							<label class="h6" for="name">Case Type:</label>
							<input class="form-control" type="text" name="case_type"/>	<br>	
							<label class="h6" for="name">Case Fee:</label>
							<input class="form-control" type="number" name="fee"/>	<br>				
						<input type="submit" name="submit" value="Submit" class="form-control btn-primary" /> 
				</form>
			</div>
		</div>
	</div>
		
</body>
</html>