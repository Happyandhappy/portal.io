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
		<nav class="menu">
			<a class="nav-link active" href="<?php echo base_url(); ?>?/Private_www/dashboard">Dashboard</a>
			<a class="nav-link" href="">Manage Data</a>
			<a class="nav-link" href="">Ledgers</a>
			<a class="nav-link" href="">Statements</a>
			<a class="nav-link" href="">Rerpots</a>
			<a class="nav-link" href="">Settings</a>
            <a class="nav-link" href="<?php echo base_url(); ?>?/clients/tickets">Support</a>

<!-- 			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/reporting">Reporting</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/enter_coins">Enter Coins</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/charts_trends">Chart &amp; Trends</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/Private_www/tax_report">Tax-Report</a>
			<a class="nav-link" href="<?php echo base_url(); ?>?/clients/tickets">Customer Support</a> -->

			
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
					<span class="after_content2"></span>
					<nav class="menu">
						<a class="nav-link active" href="dashboard.html">Dashboard</a>
                        <div class="dropdown">
                            <button class="dropbtn">Manage Data</button>
                                <div class="dropdown-content">
                                    <a class="nav-link active" href="manage-data-blockchain.html">&emsp;Blockchain</a>
                                    <a class="nav-link active" href="manage-data-exchange.html">Exchange</a>
                                    <a class="nav-link active" href="manage-data-receipts.html">Receipts & Invoices</a>
                                    <a class="nav-link active" href="manage-data-manual.html">Manual Entry</a>
                                </div>
                        </div>
                        <div class="dropdown">
                            <button class="dropbtn">Ledgers</button>
                            <div class="dropdown-content">
                                <a class="nav-link active" href="blockchain-ledger.html">&emsp;Blockchain Ledger</a>
                                <a class="nav-link active" href="exchange-ledger.html">Exchange Ledger</a>
                                <a class="nav-link active" href="general-ledger.html">General Ledger</a>
                            </div>
                        </div>                        
                        <div class="dropdown">
                            <button class="dropbtn">Statements</button>
                                <div class="dropdown-content2">
                                    <a class="nav-link active" href="cash-flow.html">&emsp;Cash Flow Statement</a>
                                    <a class="nav-link active" href="balance-sheet.html">Balance Sheet</a>
                                    <a class="nav-link active" href="income-statment.html">Income Statement</a>
                                </div>
                        </div>     
                        <div class="dropdown">
                            <button class="dropbtn">Reports</button>
                                <div class="dropdown-content">
                                    <a class="nav-link active" href="revenue-report.html">&emsp;Revenue Report</a>
                                    <a class="nav-link active" href="profit-report.html">Profit Report</a>
                                    <a class="nav-link active" href="margin-report.html">Margin Report</a>
                                </div>
                        </div>     
                        <div class="dropdown">
                            <button class="dropbtn">Settings</button>
                                <div class="dropdown-content">
                                    <a class="nav-link active" href="account-settings.html">&emsp;Account Settings</a>
                                    <a class="nav-link active" href="billing-settings.html">Billing Settings</a>
                                    <a class="nav-link active" href="manage-users.html">Manage Users</a>
                                </div>
                        </div>     
                        <div class="dropdown">
                            <button class="dropbtn">Support</button>
                                <div class="dropdown-content">
                                    <a class="nav-link active" href="knowledge-base.html">&emsp;Knowledge Base</a>
                                    <a class="nav-link active" href="faq.html">FAQ</a>
                                    <a class="nav-link active" href="contact-us.html">Contact Us</a>
                                </div>
                        </div> 
					</nav>
				</div>
<!-- 				<div class="col-md-12 col-sm-12 col-lg-5">
					<div class="account tb">
						<span class="tb-cell">
							Free membership
						</span>
						<button class="sign_in tb-cell">Sign in</button>
						<button class="new_acc tb-cell">Create an account &nbsp; <i class="fa fa-angle-double-right"></i></button>
					</div>
				</div> -->
				<div class="col-md-12 col-sm-12 col-lg-5">
					<div class="account tb">
			            <div class="right_title das_title">
							<button>Link your data &nbsp; <i class="fa fa-angle-double-right"></i></button>
						</div>                        
						<button class="new_acc tb-cell">Logout &nbsp; <i class="fa fa-angle-double-right"></i>
					</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>