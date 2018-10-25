<?php defined('BASEPATH') or exit() ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CoiFlow.ai</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/pie-chart.js"></script>
  <script src="js/coiflow.js"></script>
  <script>
  	var base_url = '<?php echo base_url(); ?>';
  </script>
</head>
<body>
<header>
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-md-8 left after_right">
					<span class="after_content"></span>
					<div class="menu-icon tb">
						<!--<span class="bar-icon tb-cell">-->
						<!--	<span class="line line1"></span>-->
						<!--	<span class="line line2"></span>-->
						<!--	<span class="line line3"></span>-->
						<!--</span>-->
						<!--<span class="tb-cell text-icon">menu</span>-->
					</div>
					<div class="socials">
						<ul>
							<li> <a href=""><i class="fa fa-facebook-f"></i></a></li>
							<li> <a href=""><i class="fa fa-twitter"></i></a></li>
							<li> <a href=""><i class="fa fa-instagram"></i></a></li>
							<li> <a href=""><i class="fa fa-google-plus"></i></a></li>
							<li> <a href=""><i class="fa fa-youtube"></i></a></li>
							<li> <a href=""><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 right"></div>
			</div>
		</div>
		<nav class="menu">
			<a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/dashboard">Dashboard</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/reporting">Reporting</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/enter_coins">Enter Coins</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/charts_trends">Chart &amp; Trends</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/tax_report">Tax-Report</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/customer_support">Customer Support</a>
		</nav>
	</div>
	<!--end topbar-->
	
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="logo">
						<a href="#"><img src="images/logo.png" alt="coin flow" /></a>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="exchange tb">
						<span class="title tb-cell">
							Summaries
						</span>
						<span class="number tb-cell">
							<input name="" value="1">
							<span class="cur">BTC</span>
						</span>
						<span class="cacul_wrap tb-cell"><span class="cacul"> = </span></span>
						<span class="result tb-cell"> $6.315,75
						</span>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="pie">
						<div class="pie-item">
							<div data-type="%" data-border="#4583de" data-percent-border="#40ccc5" class="pie-chart pie-title-center" data-percent="11">
								<div class="incicle">+<span class="pie-value"></span><span class="type_cur">Coins</span>
								</div>
							</div>
							<span class="pie_va_cur">0.7 BTC</span>
						</div>
						<div class="pie-item">
							<div data-type="%" data-border="#4583de" data-percent-border="#ffb8c1" class="pie-chart pie-title-center" data-percent="21"><div class="incicle">+ <span class="pie-value"></span> <span class="type_cur">Currencies</span></div></div>
						<span class="pie_va_cur">AUD$ 8,500</span>
						</div>
						<div class="pie-item">
							<div data-type="" data-border="#4583de" data-percent-border="#d982b0" class="pie-chart pie-title-center" data-percent="67"> <div class="incicle"><span class="pie-value"></span> <span class="type_cur">Trades</span></div></div>
						<span class="pie_va_cur">7 Coins</span>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div><!--end header-->
	
	<div class="nav">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-7 after_right">
					<span class="after_content"></span>
					<nav class="menu">
						<a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/dashboard">Dashboard</a>
						<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/reporting">Reporting</a>
						<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/enter_coins">Enter Coins</a>
						<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/charts_trends">Chart & Trends</a>
						<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/tax_report">Tax-Report</a>
						<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/customer_support">Customer Support</a>
					</nav>
				</div>
				<div class="col-md-12 col-sm-12 col-lg-5">
					<div class="account tb">
						<span class="tb-cell">
							Free membership
						</span>
						<button class="sign_in tb-cell">Sign in</button>
						<button class="new_acc tb-cell">Create an account &nbsp; <i class="fa fa-angle-double-right"></i>
					</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>