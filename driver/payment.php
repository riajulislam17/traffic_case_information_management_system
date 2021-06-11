<?php
    include"../config/db.php";
    $msg="";
	if(!isset($_COOKIE['driver'])){header("location:../config/login.php");}
    $driver_id = $_COOKIE['id'];
    if(!isset($_GET['case']))
    {
        header("location:profile.php");
    }
    else
    {
       $case_id = $_GET['case'];
        $get_data = "select * from case_list where id = $case_id";
        $run = mysqli_query($connect,$get_data);

        if(isset($_POST['submit']))
        {
            $ids = $_POST['tnxid'];
            if($ids == 112233)
            {
                $query = "UPDATE `case_list` SET `status` = '0' WHERE `case_list`.`id` = $case_id";
               $ok= $connect->query($query);
			  
                if($connect->error){
                     $msg .= "<div class='bg-danger p-2 text-light'>Something is worng</div>";
                }
               else
               {
                $msg .="<div class='bg-success p-2 text-light'>Payment Complete go to <a href='profile.php'>Profle</a></div>";
               }
            }
			else
				$msg .= "<div class='bg-danger p-2 text-light'>Wrong Transaction ID</div>";
        }
        
    }


?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	<meta charset="UTF-8">
	<title>Case Payment-<?php echo $app_name;?></title>
</head>
<body>
    
<div class="bg-info p-2">
		<div class="container">			
			<span class="h4 text-light"><?php echo $app_name;?></span>
			<span class="float-right text-light">
				Welcome (<?php echo $_COOKIE['driver'];?>) &nbsp;
				<a class="text-light text-decoration-none" href="profile.php"><i class="fas fa-home"></i></a> &nbsp;
                <a class="text-light text-decoration-none" href="../config/logout.php"><i class="fas fa-sign-out-alt"></i></a>
			</span>
		</div>
</div>



	<br>
	<div class="container">
		<div class="w-75 shadow shadow-info p-5 mx-auto">
		<div class="h5">Case Inforamtion</div>
        <?php echo $msg;?>
		<table class="table">
		<?php 		
        $row= mysqli_fetch_assoc($run);
			echo "<tr>
					<td>Case Id</td>
					<td>". $row['id'] ."</td>
				</tr>
				<tr>
					<td>Driver Id</td>
					<td>". $row['driver_id'] ."</td>
				</tr>
				<tr>	
					<td>Case Typense</td>
					<td>". $row['case_type'] ."</td>
				</tr>
				<tr>	
					<td>Amout</td>	
					<td>". $row['fine_amout'] . $row['status'] ."</td>
				</tr>";
		
			
			?>
		</table>
		<div class="h5">Payment GetWay <?php echo $case_id;?></div>
		
            <form action="payment.php?case=<?php echo $case_id;?>" method="POST">
                    <div class="radio">
                            <label><input type="radio" name="type" value="1" checked>bKash</label>
                            &nbsp; &nbsp; 
                            <label><input type="radio" name="type" value="2">DBBL</label>
                            &nbsp; &nbsp; 
                            <label><input type="radio" name="type" value="3">Sure Case</label>
                            </div>	
                <label class="h6" for="tnxid">Enter Transaction ID</label>
                <input class="form-control p-2 m-1" type="text" name="tnxid" id="tnxid">
                <input type="submit" value="Submit" name="submit" class="btn-success text-light btn">
            </form>
		
		</div>
	</div>
</body>
</html>

