<?php defined('BASEPATH') or exit() ; ?>
<section id="chart_trend">
	<div class="container heade_section">
		<div class="row head_title">
			<div class="col-sm-12">
					<div class="title">
						<h2>Ledgers</h2>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div class="desc text-center">
					<p>View your accounting ledger, search for transactions or export your data.</p>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
	<div class="container"><!--show --> 
		<div class="chart">
			<div class="head">
				<div class="row full-tab">
					<div class="col-sm-3 item">
						<span class="title_chart">Manage client ledger data</span>
					</div>
					<div class="col-sm-9 text-left item" style="position: relative; top: 20px;">
						<form class="select_tag" action="" name="" method="" >
							<div class="select_control">
							<i class="fa fa-caret-down"></i>
							  <select class="custom-select" id="">
								<option selected>Select Client</option>
								<option value="1">Doe, John</option>
								<option value="2">Doe, Jane</option>
								<option value="3">Last name, First name</option>
							  </select>
							</div>
							<div class="select_control">
							<i class="fa fa-caret-down"></i>
							  <select class="custom-select" id="">
								<option selected>Select Ledger</option>
								<option value="1">Awaiting input</option>
                                <option value="2">Trades</option>
								<option value="3">Cryptocurrency Transfers</option>
								<option value="4">Bank Transfers</option>
							  </select>
							 </div>
							<div class="select_control">
							<i class="fa fa-caret-down"></i>
                                <select class="custom-select" id="">
								<option selected>Time period</option>
								<option value="1">2015-2016</option>
								<option value="2">2016-2017</option>
								<option value="3">2017-2018</option>
                                <option value="4">3 months ago</option>
                                </select>
							 </div>
						</form>
                    <div class="execute tb" style="position: relative; bottom: 20px;">
						<button class="exe tb-cell">Generate &nbsp; <i class="fa fa-angle-double-right"></i>
                        </button>
					</div>
                    </div>
				</div>
			</div>
			<div class="content">
				<div class="collapse show" id="bicoin_chart">
				  <div class="card card-body">
					<img src="images/chart_dash.jpg" alt="" />
				  </div>
				</div>
			</div>
		</div>
	</div>
    
</section><!--end ledgers-->