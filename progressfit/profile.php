<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<?php include('conexao.php'); ?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/ionicons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/responsive.css" rel="stylesheet">
</head>

<body><div id="loader_wrpper">
		<div class="loader_style"></div>
	</div>
	<div class="wrapper">
		<!-- header -->
			<?php include('theader.php'); ?>
			<!-- header_End -->
		<!-- Content_right -->
		<div class="container_full">

				<?php include('sidebar.php'); ?>
		

			<!--main contents start-->
			<main class="content_wrapper">
				<!--page title start-->
				<div class="page-heading">
					<div class="container-fluid">
						<div class="row d-flex align-items-center">
							<div class="col-12">
								<div class="page-breadcrumb">
									<h1>Profile</h1>
								</div>
							</div>
							<div class="col-12  d-md-flex">
								<div class="breadcrumb_nav">
									<ol class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a class="parent-item" href="index.html">Home</a>
											<i class="fa fa-angle-right"></i>
										</li>
										<li class="active">
											Profile
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--page title end-->
				<div class="container-fluid">
					<!-- state start-->
					<div class="row">
						<div class="col-12">
							<div class="panel profile-cover">
								<div class="profile-cover__img">
									<img src="assets/images/01_150x150.png" alt="">
									<h3 class="h3"><?php echo($_SESSION['nome'] ); ?></h3>
								</div>
								<div class="profile-cover__action bg--img" data-overlay="0.3"></div>
								<div class="profile-cover__info">
									<ul class="nav">
										<li>
											<strong>26</strong>Projects
										</li>
										<li>
											<strong>33</strong>Followers
										</li>
										<li>
											<strong>136</strong>Following
										</li>
									</ul>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Activity Feed</h3>
								</div>
								
					</div>
					<!-- state end-->
				</div>
			</main>
			<!--main contents end-->
		</div>
		<!-- Content_right_End -->
		<!-- Footer -->
		<footer class="footer ptb-20">
			<div class="row">
				<div class="col-12 text-center">
					<div class="copy_right">
						<p>
							2019 © Dashboard Theme By
							<a href="#">Intellir</a>
						</p>
					</div>

				</div>
			</div>
		</footer>
		<!-- Footer_End -->
	</div>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/popper.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="assets/js/custom.js" type="text/javascript"></script>
</body>

</html>
