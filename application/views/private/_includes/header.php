<?php defined('BASEPATH') or exit() ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Coinflow.ai</title>
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
					<div class="socials">
						<ul>
							<li> <a href="https://www.facebook.com/coinflowai/"><i class="fa fa-facebook-f"></i></a></li>
							<li> <a href="https://twitter.com/coinflow_ai"><i class="fa fa-twitter"></i></a></li>
							<li> <a href="https://www.linkedin.com/company/coinflow-ai"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 right"></div>
			</div>
		</div>
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

				</div>
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="pie">
						<div class="pie-item">
							<div data-type="%" data-border="#4583de" data-percent-border="#40ccc5" class="pie-chart pie-title-center" data-percent="33">
								<div class="incicle">+<span class="pie-value"></span><span class="type_cur">Revenue</span>
								</div>
							</div>
							<span class="pie_va_cur">$54,654</span>
						</div>
						<div class="pie-item">
							<div data-type="%" data-border="#4583de" data-percent-border="#d982b0" class="pie-chart pie-title-center" data-percent="14"><div class="incicle">+ <span class="pie-value"></span> <span class="type_cur">Expenses</span></div></div>
						<span class="pie_va_cur">$24,550</span>
						</div>
						<div class="pie-item">
							<div data-type="%" data-border="#4583de" data-percent-border="#ffb8c1" class="pie-chart pie-title-center" data-percent="67"> <div class="incicle">+<span class="pie-value"></span> <span class="type_cur">Profit</span></div></div>
						<span class="pie_va_cur">$30,104</span>
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
                        <a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/mng_client">Manage Clients</a>
                        <a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/upload_data">Upload Data</a>
                        <a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/ledgers">Ledgers</a>
                        <a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/statements">Statements</a>
                        <div class="dropdown">
                            <button class="dropbtn">Settings</button>
                                <div class="dropdown-content">
                                    <a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/account_settings">&emsp;Account Settings</a>
                                    <a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/billing_settings">Billing Settings</a>
                                </div>
                        </div>     
                        <div class="dropdown">
                            <button class="dropbtn">Support</button>
                                <div class="dropdown-content">
                                    <a class="nav-link active" href="<?php echo base_url(); ?>?knowledge-base">&emsp;Knowledge Base</a>
                                    <a class="nav-link active" href="<?php echo base_url(); ?>?/Public_www/faq">FAQ</a>
                                    <a class="nav-link active" href="<?php echo base_url(); ?>?/Public_www/contact_us">Contact Us</a>
                                </div>
                        </div> 
					</nav>
				</div>
				<div class="col-md-12 col-sm-12 col-lg-5">
					<div class="account tb">
                                    <div class="right_title das_title">
								<button>Manage Clients &nbsp; <i class="fa fa-angle-double-right"></i></button>
							</div>                        
						<button class="new_acc tb-cell">Logout &nbsp; <i class="fa fa-angle-double-right"></i>
					</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
</header>
