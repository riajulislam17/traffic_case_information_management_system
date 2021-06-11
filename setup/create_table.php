<?php
	include "../config/db.php";
	$msg="";	$msgs="";
	
	
	$table_admin= "CREATE TABLE admin(
		id int AUTO_INCREMENT NOT null PRIMARY KEY,
		user varchar(30),
		pass varchar(30),				
		time timestamp
	)";
	
	$table_user= "CREATE TABLE user(
		id int AUTO_INCREMENT NOT null PRIMARY KEY,
		user varchar(30),
		pass varchar(30),				
		time timestamp
	)";
	
	
	
	$table_department = "CREATE TABLE driver_information(
		driver_id int AUTO_INCREMENT NOT null PRIMARY KEY,
		name varchar(30),	
		phone_number int,
		license_number varchar(20),
		address varchar(255),
		case_count int,
		rating int,
		password varchar(50),
		time timestamp
	)
	";
	$table_student= "CREATE TABLE case_list(
									id int AUTO_INCREMENT NOT null PRIMARY KEY,
									driver_id int,									
									case_type varchar(255),
									fine_amout int,
									status int DEFAULT '1',
									FOREIGN KEY(driver_id) REFERENCES driver_information(driver_id)	
								)";
	$create = $connect->query($table_user);
	$create1 = $connect->query($table_student);
	$create2 = $connect->query($table_department);
	$create3 = $connect->query($table_admin);
	
	if(!$create){$msg.= $connect->error;}
	if(!$create1){$msg.= $connect->error;}
	if(!$create2){$msg.= $connect->error;}
	if(!$create3){$msg.= $connect->error ."<div class='h1 bg-danger text-light'>Table Already Exits</div><a href='../admin/register_admin.php'> Register </a>New User..";}
	else
	{
		$msgs .= "<center><div class='mx bg-danger text-light'>
		<div class='h2 bg-danger text-light'>	<?php echo $msg;?> Table Created successfully Now,</div>
	<a href='../admin/register_admin.php'> Register </a>New User..
	</div><center>";
	}
	
	 
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>

	<meta charset="UTF-8">
	
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/js/bootstrap.js" />
	
	<title>Table Create</title>
</head>
<body>
	
	<?php echo $msg;?>
	<?php echo $msgs;?>
	
	
	
</body>
</html>