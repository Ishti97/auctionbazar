<?php
//include '../Include/DB.php';
include '../Include/DB.php';
// error_reporting(0);

// session_start();

// if (!isset($_SESSION['Email'])) {
//     header("Location: ../Login/admin.php");
// }

?>

<!DOCTYPE html>
<html lang="en">
<!-- <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Admin Approval Of Product</title>
</head> -->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--<link rel="stylesheet" type="text/css" href="/Include/style.css">
--><link rel="stylesheet" type="text/css" href="../Include/nav.css">
	<title>Product Approval</title>
	<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  /* background-color: #68cca7; */
  background-color: #DF966C;
  color: white;
}
</style>
</head>











<body>

	<div class="">
		
		<h2 style="color:#DF966C;" align="center">Product Approval</h2>

			<table width="1000" border="5" align="center" id="customers">
			<thead class="thead-dark">
				<tr>
					<th  >ID</th>
					<th>Name</th>
					<th>Category</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
				</thead>

				<?php
					// $_SESSION['Email'] = $row['Email'];
					// $_SESSION['Username'] = $row['Username'];
					
					$serial = 0;
					$sql = "SELECT * FROM product WHERE Status='pending'";
					$result = mysqli_query($conn, $sql);
					
					if ($result->num_rows > 0) {
										
						while($row = mysqli_fetch_assoc($result)){
					
						
							$username = $row['Id'];
							$email = $row['Price'];
							$contactno = $row['Name'];
							$designation = $row['Category'];
							$image = $row['Image'];
							$serial++;
										
				?>
				
				<tbody>				
				<tr>
					
					<td><?php echo $username;?></td>
					<!-- <td><?php echo $email;?></td> -->
					<td><?php echo $contactno;?></td>
					<td><?php echo $designation;?></td>
					<td><img src="../Images/Product/<?php echo $image; ?>" width="40px" height="auto" alt="">
								</td>
					<td>
						<form action="admin-approve-reviewer.php" method="post">
						<input type="hidden" name="email" value="<?php echo $_SESSION['Email'];?>"/>
						<input type="hidden" name="username" value="<?php echo $username;?>"/>
						<input type="submit" name="approve" value="&#x2713" />
						<input type="submit" name="deny" value="&#10060"/>
						</form>
					</td>
				</tr>
				</tbody>

					<?php }} ?>
				
			</table>
	</div>

<?php


if(isset($_POST["approve"])){

	$id = $_POST['username'];
	
	$sql = "UPDATE product SET Status='approved' WHERE Id='$id'";
		$result = mysqli_query($conn, $sql);
	
	// echo '<script type = "text/javascript">';
	// echo 'alert("User Approved!");';
	// echo '</script>';

	header("location:admin-approve-reviewer.php");

#x2705;

}

if(isset($_POST["deny"])){

	$id = $_POST['username'];
		
	 $sql = "DELETE FROM product WHERE Id='$id'";
	$result = mysqli_query($conn, $sql);
	
	// echo '<script type = "text/javascript">';
	// echo 'alert("User Denied!");';
	
	// echo '</script>';
	header("location:admin-approve-reviewer.php");
	
}

?>

</body>
</html>