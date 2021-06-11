<?php
	include"../config/db.php";$msg = "";$tr = "";$table = "";
	if(!isset($_COOKIE['sergeant'])){header("location:../config/login.php");}
	if(isset($_POST['submit']))
	{
		$search_data = $_POST['search'];
		$q = "select * from driver_information where license_number LIKE '%".$search_data."%' ";
		$data = mysqli_query($connect,$q);
		$count = mysqli_num_rows($data);
		if($count>0)
		{
			while($array= mysqli_fetch_assoc($data))
			{
				$tr .="<tr>
				<td>".$array['name']."</td>
				<td>".$array['phone_number']."</td>
				<td>".$array['license_number']."</td>
				<td>".$array['address']."</td>
				<td>".$array['case_count']."</td>
				<td>".$array['rating']."</td>
				<td>".$array['time']."</td>				
				<td><a href='add.php?driver_id=".$array['driver_id']."'>Case</a></td>				
				</tr>";
				
			}
			$table = "<table class='table'>
			<tr>
				<th>Name</th>
				<th>Phone</th>
				<th>License</th>
				<th>Address</th>
				<th>Case Count</th>
				<th>Rating</th>
				<th>Joined at</th>
				<th>Action</th>
			</tr>
			$tr
			</table>";

		}else
		{
			$table= "No data found <i class='far fa-frown'></i>";
		}
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	
	<title>Search Driver -<?php echo $app_name;?></title>
</head>
<body>
	<div class="bg-info p-2">
		<div class="container">		
				<span class="h4 text-light">
				<a class="text-decoration-none text-light" href=""><?php echo $app_name;?></a>
				</span> 
		
			<span class="float-right text-light">
			Welcome (<?php echo $_COOKIE['sergeant'];?>) &nbsp;
			<a class="h5 text-light text-decoration-none" href="../config/logout.php" title="Logout"> <i class="fas fa-sign-out-alt"></i></a>
			</span>
		</div>
	</div>
	<div class="container">
	<br>
	<?php echo $msg;?>
				<form class="form-group" action="search.php" method="POST">		
				<label class="h5" for="name">Search Driving license:</label>
				<input class="form-control" type="text" name="search"/>
				<br />		
			<input class="form-control btn-info" type="submit" value="Search" name="submit" />								
		</form>

		<?php echo $table;?>
	</div>

		
		
</body>
</html>