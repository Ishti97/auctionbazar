<?php

include '../Include/DB.php';
//error_reporting(0);
session_start();
$username = $_GET['username'];
$identity = $_GET['identity'];
$id = $_GET['id'];

?>


<?php


if (isset($_POST['add'])) {

	$rating = $_POST["rating"];
	$tmp_rating = 0;
	$temp_rated_by = 0;

	$sql = "SELECT rated_by FROM product WHERE Id=$id";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$temp_rated_by = $row["rated_by"];
		}
	}


	$sql3 = "SELECT rating FROM product WHERE Id=$id ";
	$result3 = mysqli_query($conn, $sql3);


	if ($result3->num_rows > 0) {

		while ($row3 = mysqli_fetch_assoc($result3)) {

			$tmp_rating = $row3["rating"];
		}
		$tmp = $rating +  $tmp_rating;
		$temp_rated_by = $temp_rated_by + 1;
		$up_rating = $tmp / $temp_rated_by;
		echo $up_rating;
	}
	$sql4 = "UPDATE product SET rating=' $up_rating' WHERE Id=$id";
	$rslt = mysqli_query($conn, $sql4);

	$sql5 = "UPDATE product SET rated_by=' $temp_rated_by' WHERE Id=$id";
	$rslt5 = mysqli_query($conn, $sql5);

	if ($rslt5) {
		$rating = "";
		header("Location: ../main.php?username=$username&identity=$identity");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}







if (isset($_POST['submit2'])) {
	$price = $_POST['bidamount'];
	$curprice = $_POST['curprice'];
	// echo $curprice;

	if ($curprice < $price) {
		$sql = "Update product SET Price = '$price' WHERE Id = '$id' ";
		$result = mysqli_query($conn, $sql);


		$sql5 = "INSERT INTO winner (Id, username, bid)
      VALUES ('$id', '$username', '$price') ";
		$result5 = mysqli_query($conn, $sql5);

		if ($result) {
			echo "<script>alert('Bid Successful, Thank you!')</script>";
			// header("Location: ../main.php?username=$get_username&identity=$identity");
		}
		
	}else{
		//echo "<script>alert('Please Bid valid amount')</script>";
	}
}








if (isset($_POST['submit'])) {

	$sql1 = "SELECT * FROM product WHERE Id='$id'";
	$result = mysqli_query($conn, $sql1);

	$pname = "";
	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {

			$pname = $row['Name'];
			$pprice = $row['Price'];
		}
	}

	$sql = "INSERT INTO cart (ProductId, ProductName, Price, Buyer) VALUES ($id, '$pname', $pprice, '$username')";
	$result = mysqli_query($conn, $sql);

	if ($result) {

		echo "<script>alert('Wow! Added to Cart.')</script>";
		header("Location: ../main.php?username=$get_username&identity=$identity");
	} else {
		echo "<script>alert('Woops! Something Wrong Went.')</script>";
	}
}

?>








<!doctype html>
<html class="no-js" lang="en">

<head>
	<!-- meta data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!--font-family-->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

	<!-- title of site -->
	<title>AuctionBits</title>

	<!-- For favicon png -->
	<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png" />

	<!--font-awesome.min.css-->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!--linear icon css-->
	<link rel="stylesheet" href="assets/css/linearicons.css">

	<!--animate.css-->
	<link rel="stylesheet" href="assets/css/animate.css">

	<!--owl.carousel.css-->
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

	<!--bootstrap.min.css-->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- bootsnav -->
	<link rel="stylesheet" href="assets/css/bootsnav.css">

	<!--style.css-->
	<link rel="stylesheet" href="assets/css/style.css">

	<!--responsive.css-->
	<link rel="stylesheet" href="assets/css/responsive.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>
	<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->




	<?php
	$conn = new mysqli('localhost', 'root', '', 'auctionbits');
	$sql = "SELECT product.Id, product.Name, product.Category, product.Price, product.Description, product.Image, product.rating, product.eventdt 
			FROM product WHERE Id = '$id'";
	$result = $conn->query($sql);
	?><?php
				if ($result->num_rows > 0) {
					// output data of each row
					while ($row = $result->fetch_assoc()) {
						$pic = "/auctionbits/Images/Product/";
				?>






	<!--welcome-hero start -->
	<header id="home" class="welcome-hero">

		<div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
			<!--/.carousel-indicator -->
			<ol class="carousel-indicators">
				<li data-target="#header-carousel" data-slide-to="0" class="active"><span class="small-circle"></span></li>
				<li data-target="#header-carousel" data-slide-to="1"><span class="small-circle"></span></li>
				<li data-target="#header-carousel" data-slide-to="2"><span class="small-circle"></span></li>
			</ol><!-- /ol-->
			<!--/.carousel-indicator -->

			<!--/.carousel-inner -->
			<div class="carousel-inner" role="listbox">
				<!-- .item -->
				<div class="item active">
					<div class="single-slide-item slide1">
						<div class="container">
							<div class="welcome-hero-content">
								<div class="row">
									<div class="col-sm-7">
										<div class="single-welcome-hero">
											<div class="welcome-hero-txt">

												<h2><?php echo $row['Name'] ?></h2>


												<p>
													<?php echo $row['Description'] ?>


													<h4> &#11088;  <?php echo $row['rating'] ?> </h4>
												<!-- <img src="../Images/star-rating.jpg" width="30px" height="20px" alt=""> -->
											
												<br />
												<br />
												<h4> &#9200; Ending  <?php echo $row['eventdt'] ?> </h4>
												</p>
												Current Bid
												<div class="packages-price">
													<p>
														$<?php echo $row['Price']*.8 ?>
														<del>$<?php echo $row['Price'] ?></del>
													</p>



												
											

													<form action="" method="POST" class="" enctype="multipart/form-data">
													<br />
												    
													<div >
														<input type="text" placeholder="" name="bidamount" value="" required>
													</div>
													<input type="hidden" name="curprice" value="<?php echo $row['Price']; ?>" />
												

													<button name="submit2" class="btn-cart welcome-add-cart" onclick="window.location.href='#'">
													Bid Here
												</button>
												</form>

												</div>

												<form action="" method="POST" class="" enctype="multipart/form-data">

												

												
												
												<button name="submit" class="btn-cart welcome-add-cart welcome-more-info"  onclick="window.location.href='#'">
													<span class="lnr lnr-plus-circle"></span>
													add <span>to</span> cart
												</button>
											
												</form>




												
												

												
												






												<!-- <form action="" method="post" enctype="multipart/form-data" class="login-email">

													<div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
													</div>
													<span class='result'>Rating : 0</span>
													<input type="hidden" name="rating">
													<div><input type="submit" name="add" class="btn btn-outline-dark my-3"> </div>

												</form> -->


												























											</div>
											<!--/.welcome-hero-txt-->
										</div>
										<!--/.single-welcome-hero-->
									</div>
									<!--/.col-->
									<div class="col-sm-5">
										<div class="single-welcome-hero">
											<div class="welcome-hero-img">
												<img src="<?php echo $pic . $row['Image'] ?>" alt="slider image">
											</div>
											<!--/.welcome-hero-txt-->
										</div>
										<!--/.single-welcome-hero-->
									</div>
									<!--/.col-->
								</div>
								<!--/.row-->
							</div>
							<!--/.welcome-hero-content-->
						</div><!-- /.container-->
					</div><!-- /.single-slide-item-->

				</div><!-- /.item .active-->

			</div><!-- /.carousel-inner-->

		</div>
		<!--/#header-carousel-->

















<?php
					}
				} ?>
<!-- top-area Start -->
<div class="top-area">
	<div class="header-area">
		<!-- Start Navigation -->
		<nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

			<!-- Start Top Search -->
			<div class="top-search">
				<div class="container">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-search"></i></span>
						<input type="text" class="form-control" placeholder="Search">
						<span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
					</div>
				</div>
			</div>
			<!-- End Top Search -->

			<div class="container">
				<!-- Start Atribute Navigation -->
				<div class="attr-nav">
					<ul>
						<li class="search">
							<a href="#"><span class="lnr lnr-magnifier"></span></a>
						</li>
						<!--/.search-->
						<li class="nav-setting">
							<a href="#"><span class="lnr lnr-cog"></span></a>
						</li>
						<!--/.search-->

					</ul>
				</div>
				<!--/.attr-nav-->
				<!-- End Atribute Navigation -->

				<!-- Start Header Navigation -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
						<i class="fa fa-bars"></i>
					</button>
					<a class="navbar-brand" href="index.html">Auction<span>Bits</span>.</a>

				</div>
				<!--/.navbar-header-->
				<!-- End Header Navigation -->

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
					<ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
						<li class=" "><a href="../main.php?&username=<?php echo $username; ?>&identity=<?php echo $identity; ?>">home</a></li>
						<!-- <li class=""><a href="www.google.com">new arrival</a></li> -->
						<li class=""><a href="#feature">features</a></li>
						<li class=""><a href="#blog">blog</a></li>
						<li class=""><a href="#newsletter">contact</a></li>
					</ul>
					<!--/.nav -->
				</div><!-- /.navbar-collapse -->
			</div>
			<!--/.container-->
		</nav>
		<!--/nav-->
		<!-- End Navigation -->
	</div>
	<!--/.header-area-->
	<div class="clearfix"></div>

</div><!-- /.top-area-->
</div><!-- top-area End -->

	</header>
	<!--/.welcome-hero-->
	<!--welcome-hero end -->







	<!--newsletter strat -->
	<section id="newsletter" class="newsletter">
		<div class="container">
			<div class="hm-footer-details">
				<div class="row">
					<div class=" col-md-3 col-sm-6 col-xs-12">
						<div class="hm-footer-widget">
							<div class="hm-foot-title">
								<h4>information</h4>
							</div>
							<!--/.hm-foot-title-->
							<div class="hm-foot-menu">
								<ul>
									<li><a href="#">about us</a></li>
									<!--/li-->
									<li><a href="#">contact us</a></li>
									<!--/li-->
									<li><a href="#">news</a></li>
									<!--/li-->
									<li><a href="#">store</a></li>
									<!--/li-->
								</ul>
								<!--/ul-->
							</div>
							<!--/.hm-foot-menu-->
						</div>
						<!--/.hm-footer-widget-->
					</div>
					<!--/.col-->
					<div class=" col-md-3 col-sm-6 col-xs-12">
						<div class="hm-footer-widget">
							<div class="hm-foot-title">
								<h4>collections</h4>
							</div>
							<!--/.hm-foot-title-->
							<div class="hm-foot-menu">
								<ul>
									<li><a href="#">wooden chair</a></li>
									<!--/li-->
									<li><a href="#">royal cloth sofa</a></li>
									<!--/li-->
									<li><a href="#">accent chair</a></li>
									<!--/li-->
									<li><a href="#">bed</a></li>
									<!--/li-->
									<li><a href="#">hanging lamp</a></li>
									<!--/li-->
								</ul>
								<!--/ul-->
							</div>
							<!--/.hm-foot-menu-->
						</div>
						<!--/.hm-footer-widget-->
					</div>
					<!--/.col-->
					<div class=" col-md-3 col-sm-6 col-xs-12">
						<div class="hm-footer-widget">
							<div class="hm-foot-title">
								<h4>my accounts</h4>
							</div>
							<!--/.hm-foot-title-->
							<div class="hm-foot-menu">
								<ul>
									<li><a href="#">my account</a></li>
									<!--/li-->
									<li><a href="#">wishlist</a></li>
									<!--/li-->
									<li><a href="#">Community</a></li>
									<!--/li-->
									<li><a href="#">order history</a></li>
									<!--/li-->
									<li><a href="#">my cart</a></li>
									<!--/li-->
								</ul>
								<!--/ul-->
							</div>
							<!--/.hm-foot-menu-->
						</div>
						<!--/.hm-footer-widget-->
					</div>
					<!--/.col-->
					<div class=" col-md-3 col-sm-6  col-xs-12">
						<div class="hm-footer-widget">
							<div class="hm-foot-title">
								<h4>newsletter</h4>
							</div>
							<!--/.hm-foot-title-->
							<div class="hm-foot-para">
								<p>
									Subscribe to get latest news,update and information.
								</p>
							</div>
							<!--/.hm-foot-para-->
							<div class="hm-foot-email">
								<div class="foot-email-box">
									<input type="text" class="form-control" placeholder="Enter Email Here....">
								</div>
								<!--/.foot-email-box-->
								<div class="foot-email-subscribe">
									<span><i class="fa fa-location-arrow"></i></span>
								</div>
								<!--/.foot-email-icon-->
							</div>
							<!--/.hm-foot-email-->
						</div>
						<!--/.hm-footer-widget-->
					</div>
					<!--/.col-->
				</div>
				<!--/.row-->
			</div>
			<!--/.hm-footer-details-->

		</div>
		<!--/.container-->

	</section>
	<!--/newsletter-->
	<!--newsletter end -->

	<!--footer start-->
	<footer id="footer" class="footer">
		<div class="container">
			<div class="hm-footer-copyright text-center">
				<div class="footer-social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-instagram"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-pinterest"></i></a>
					<a href="#"><i class="fa fa-behance"></i></a>
				</div>
				<p>
					&copy;copyright. designed and developed by <a href="https://www.themesine.com/">themesine</a>
				</p>
				<!--/p-->
			</div>
			<!--/.text-center-->
		</div>
		<!--/.container-->

		<div id="scroll-Top">
			<div class="return-to-top">
				<i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
			</div>

		</div>
		<!--/.scroll-Top-->

	</footer>
	<!--/.footer-->
	<!--footer end-->

	<!-- Include all js compiled plugins (below), or include individual files as needed -->

	<script src="assets/js/jquery.js"></script>

	<!--modernizr.min.js-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

	<!--bootstrap.min.js-->
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- bootsnav js -->
	<script src="assets/js/bootsnav.js"></script>

	<!--owl.carousel.js-->
	<script src="assets/js/owl.carousel.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>


	<!--Custom JS-->
	<script src="assets/js/custom.js"></script>

</body>

</html>