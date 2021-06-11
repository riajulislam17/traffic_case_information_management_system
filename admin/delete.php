<script type="text/javascript">
	function redirect(){
		setTimeout(function(){
			 window.location.href = "index.php";			
		},3000)
	}
</script>
<?php
	include "../config/db.php";

	if(isset($_GET['type']) && isset($_GET['id']))
	{
		if($_GET['type'] === 'user'){
		 $type = $_GET['type'];
		 $id = $_GET['id'];
		
			$query= "DELETE FROM `$type` WHERE `$type`.`id` = $id";
			$connect->query($query);
			if($connect->error)
			{
				echo "Delete failed:". $connect->error;
			}
			else{
				echo "<br /><br /><br /><div align='center' class='h4 bg-success text-light p-5 m-5 mx-auto w-75'>Delete Successfully  <span>Go <a class='text-danger' href='index.php'>back</a></span></div>";
				/*echo "<script>
					redirect();
				</script>";*/
			}
		}
		else
		{
			$type = 'driver_information';
			 $id = $_GET['id'];
			
			$query= "DELETE FROM `$type` WHERE `$type`.`driver_id` = $id";
			$connect->query($query);
			if($connect->error)
			{
				echo "Delete failed:". $connect->error;
			}
			else{
				echo "<br /><br /><br /><div align='center' class='h4 bg-success text-light p-5 m-5 mx-auto w-75'>Delete Successfully  <span>Go <a class='text-danger' href='index.php'>back</a></span></div>";
				/*echo "<script>
					redirect();
				</script>";*/
			}
		}
	}else
	{
		header("location:index.php");
		
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Delte Student- Database Project</title>
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/js/bootstrap.js" />
</head>
<body>
	
</body>
</html>