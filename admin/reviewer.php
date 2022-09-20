<?php
	// include '../Include/DB.php';

	// error_reporting(0);

	// session_start();

	// if(!isset($_SESSION['Identity']) && $_SESSION['Identity'] != "reviewer") {
	// 	  header("Location: ../Login/reviewer.php");
	// 		die();
	// }

	// if (!isset($_SESSION['Logged'])) {
	// 	 header("Location: ../Login/reviewer.php");
	// 	die();
	// }

	// if($_SESSION['Username']==true && $_SESSION['Logged']==true){
		
	// 	if((time() - $_SESSION['Time']) > 120){
	// 			 header("Location: ../Logout/reviewer.php");
	// 	}
	// 	else{
			
	// 		$identity = $_SESSION['Identity'];
	// 		$email = $_SESSION['Email'];
	// 		$username = $_SESSION['Username'];
			
	// 	}
	// }
	// else{
	// 	 header("Location: ../Logout/reviewer.php");
	// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
	
	<!--<link rel="stylesheet" type="text/css" href="../Include/style.css">
	--><link rel="stylesheet" type="text/css" href="../Include/nav.css">
	
	<title>Reviewer</title>
</head>
<body>


		<div class="topnav" id="myTopnav">
			<a href="../index.php" class="btn btn-outline-dark my-3">HOME</a>
			<a href="../UpdateProfile/reviewer.php?username=<?php echo $_SESSION['Username']; ?> " class="btn btn-outline-dark my-3">| Update Profile</a>
			<a href="../Logout/reviewer.php" class="btn btn-outline-dark my-3">| Sign Out</a>
			
			<?php if($_SESSION['Identity']== "reviewer") { ?>
	
			<a href="../Approve/reviewer-approve-organization.php?username=<?php echo $_SESSION['Username']; ?> " class="btn btn-outline-dark my-3">| APPROVE ORGANIZATION</a>
		
			<?php } ?>
			
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
			<i class="fa fa-bars"></i>
			</a>
	</div>
	

	<div class="container">
		   <!--<form action="" method="post" enctype="multipart/form-data" class="login-email">-->
				
				 <p class="login-text" style=" font-size: 2rem; font-weight: 700;"><u> Info| Reviewer</u></p>
			
				
				<?php 
					$sql = "SELECT * FROM reviewer WHERE Email='{$_SESSION["Email"]}'";
					$result = mysqli_query($conn, $sql);
					
					if ($result->num_rows > 0) {
						
						$row = mysqli_fetch_assoc($result);
						// $_SESSION['Email'] = $row['Email'];
						// $_SESSION['Username'] = $row['Username'];
						
				?>
					
					<img src="../Images/Reviewer/<?php echo $row["Image"]; ?>" width="150px" height="auto" alt="">
					
				
						<p class="login-text" style="font-size: 1rem; font-weight: 800;">Name: <?php echo $row["Username"]; ?></p>
				
				<p class="login-text" style="font-size: 1rem; font-weight: 800;">Designation: <?php echo $row["Designation"]; ?></p>
				
					<p class="login-text" style="font-size: 1rem; font-weight: 800;">Contact: <?php echo $row["ContactNo"]; ?></p>
				
					
				<?php } ?>	
			<!--</form>-->
		</div>


	<?php if($_SESSION['Identity']== "reviewer") { ?>
	
<div class="container mt-5">
<p class="login-text" style="font-size: 2rem; font-weight: 800;">Rate Donor</p>
		<?php   
		
			$sql1 = "SELECT * FROM donator ";
			$result1 = mysqli_query($conn, $sql1);
			
				while($row1 = mysqli_fetch_assoc($result1)){
					$donar = $row1["Username"];
			?>
			
<ul>	 
	 <li><a href="../Dashboard/donar-public.php?donar=<?php echo $donar; ?>&reviewer=<?php echo $username;?>" class="btn btn-light"><?php echo $donar; ?> <span class="text-danger">&rarr;</span></a>	
</li>
</ul>			
			<?php } ?>
	</div>
	
	
<?php } ?>
</body>
</html>