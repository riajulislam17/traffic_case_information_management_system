<?php
	include"../config/db.php";
	if(!isset($_COOKIE['driver'])){header("location:../config/login.php");}
	$driver_id = $_COOKIE['id'];
	$query= "SELECT * FROM `driver_information` where driver_id=$driver_id";
	$query_run = mysqli_query($connect,$query);	
	$row = mysqli_fetch_assoc($query_run);
		$driver_id= $row['driver_id'];
		$case_query = mysqli_query($connect,"SELECT * FROM `case_list` where driver_id=$driver_id");
		$case_count = mysqli_num_rows($case_query);
	

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	<meta charset="UTF-8">
	<title>Profile-<?php echo $app_name;?></title>
</head>
<body>
<div class="bg-info p-2">
		<div class="container">			
			<span class="h4 text-light"><?php echo $app_name;?></span>
			<span class="float-right text-light">
				Welcome (<?php echo $_COOKIE['driver'];?>) &nbsp;
				<a class="text-light text-decoration-none" href="../config/logout.php"><i class="fas fa-sign-out-alt"></i></a>
			</span>
		</div>
</div>



	<br>
	<div class="container">
		<div class="w-75 shadow shadow-info p-5 mx-auto">
		<div class="h5">Inforamtion</div>
		<table class="table">
		<?php 		
		
			echo "<tr>
					<td>Name</td>
					<td>". $row['name'] ."</td>
				</tr><tr>
					<td>Phone</td>
					<td>". $row['phone_number'] ."</td>
				</tr><tr>	
					<td>License</td>
					<td>". $row['license_number'] ."</td>
				</tr><tr>	
					<td>Address</td>	
					<td>". $row['address'] ."</td>
				</tr><tr>	
					<td>Total Case</td>	
					<td>". $row['case_count'] ."</td>
				</tr><tr>	
					<td>Rating</td>	
					<td>". $row['rating'] ."</td>
					</tr><tr>	
					<td>Time</td>
					<td>". $row['time'] ."</td>
			</tr>";
		
			
			?>
		</table>
		<div class="h5">Case List</div>
		
		<?php 
			if($case_count>0)
			{
				echo"<table class='table'>
				<tr>
					<th>Case Type</th>
					<th>Fine Amount</th>
					<th>Payment Status</th>
				</tr>
				";
				
					while($array=mysqli_fetch_assoc($case_query))
					{
						$id = $array['id'];
						if($array['status'] == 0){$status= "Complete";}else{$status= "Incomplete <a href='payment.php?case=$id'>Go Payment</a> ";} 
						echo "<tr>							
							<td>".$array['case_type']."</td>
							<td>".$array['fine_amout']."</td>
							<td>". $status ."</td>
						</tr>";
					}
					echo "</table>";
					
					
			}
			else echo"No case found :)";
		?>
		</div>
	</div>
</body>
</html>

