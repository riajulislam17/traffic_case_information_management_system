<?php
	include "../config/db.php";
	if(!isset($_COOKIE['admin']))
	{
		header("location:../config/login.php");
	}
	$user= $_COOKIE['admin'];
	
	 function find_dirver($id)
	{
		include "../config/db.php";
		
		$query= "SELECT user FROM `user` WHERE id=$id";
		$r = mysqli_query($connect,$query);
		$result_array = mysqli_fetch_assoc($r);
		if(mysqli_num_rows($r)<0)
		{
			return null;
		}else
		{
			return $result_array;
		}
		
	}
	
	
	
	
	
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	<title>Welcome to <?php echo $app_name;?></title>
</head>
<body>

	<div class="bg-info text-light p-2">
		<div class="container mx-auto">
			<span class="h4"><?php echo $app_name;?></span> <small>(Admin Panel)</small> 
			<div class="float-right"> 

				Welcome (<?php echo $_COOKIE['admin']; ?>)
				&nbsp;&nbsp;
				<a title="Logout" class="text-light" href="../config/logout.php"><i class="fas fa-sign-out-alt"></i></a>
			</div> 
		</div>
	</div>

<div class="container p-2 mt-3">
  <div class="row">
    <div class="col">
		<div class="h5 bg-info p-2 text-light">Sergeant List
		<span class="float-right">
			<a class="text-light" title="Register New Sergeant" href="add_sergeant.php"><small>Add</small> <i class="fas fa-plus-circle"></i></a></span> </div>
		<table class="table">
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Time Joined</th>				
				<th>Action</th>
			</tr>
			<?php
				$qs = mysqli_query($connect,"select * from user");
				$ucount = mysqli_num_rows($qs);
				if($ucount >0)
				{
					while($department = mysqli_fetch_assoc($qs))
					{
						echo "<tr>
					<td>".$department['id']."</td>
					<td>".$department['user']."</td>
					<td >".$department['time']."</td>
					<td>
						
						<a href='delete.php?type=user&id=".$department['id']."'>Delete</a>
					</td>				
						</tr> ";
					}
					
				}else
				{
					echo "<tr><td colspan='4'>Nothing Found :(</td></tr>";
				}
				
			?>
		</table>
	</div>
    <div class="col">
		<div class="h5 bg-info p-2 text-light"> Driver list 
			<span class="float-right"><a title="Register new driver" class="text-light" href="add_driver.php"><small>Add</small> <i class="fas fa-plus-circle"></i></a></span> 
		</div>
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Toal Case</th>				
				<th>Rating</th>
				
				
			</tr>
			<?php
				$q = mysqli_query($connect,"SELECT * FROM `driver_information`");
				$dcount =mysqli_num_rows($q);
				if($dcount>0)
				{
					while($driver = mysqli_fetch_assoc($q))
					{
						echo "<tr>
							
					<td>".$driver['name']."</td>
					<td>".$driver['case_count']."</td>
					<td>".$driver['rating']."</td>	
									
				
						</tr> ";
						
					}
				}
				else
				{
					echo "<tr><td colspan='4'>Nothing Found :(</td></tr>";
				}
				
				
				
			?>
		</table>
		
	</div>    
    
  </div>
</div>
	
	
</body>
</html>