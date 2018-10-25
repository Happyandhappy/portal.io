<?php defined('BASEPATH') or exit() ; ?>
<section id="chart_trend">
	<div class="container heade_section">
		<div class="row head_title">
			<div class="col-sm-12">
					<div class="title">
						<h2> Charts</h2>
						<div class="right_title">
							Start now.&nbsp;&nbsp;<button class="sign_in">Sign up</button>
						</div>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div class="desc text-center">
					<p>All current and historical prices for 5,417 existing currencies provides you with a comprehensive insight onto the patterns of the cryptocurrency landscape.</p>
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
						<span class="title_chart">Bitcoin price in AUD</span>
					</div>
					<div class="col-sm-9 text-right item">
						<form class="select_tag" action="" name="" method="">
							<div class="select_control">
							<i class="fa fa-caret-down"></i>
							  <select class="custom-select" id="">
								<option selected>Line chart (BTC and AUD)</option>
								<option value="1">Line chart (BTC and AUD)</option>
								<option value="2">Line chart (BTC and AUD)</option>
								<option value="3">Line chart (BTC and AUD)</option>
							  </select>
							</div>
							<div class="select_control">
							<i class="fa fa-caret-down"></i>
							  <select class="custom-select" id="">
								<option selected>Hide my trades</option>
								<option value="1">Hide my trades</option>
								<option value="2">Hide my trades</option>
								<option value="3">Hide my trades</option>
							  </select>
							 </div>
							<div class="select_control">
							<i class="fa fa-caret-down"></i>
							  <select class="custom-select" id="">
								<option selected>Fast (low details)</option>
								<option value="1">Fast (low details)</option>
								<option value="2">Fast (low details)</option>
								<option value="3">Fast (low details)</option>
							  </select>
							 </div>
							<div class="select_control">
							<i class="fa fa-caret-down"></i>
							  <select class="custom-select" id="">
								<option selected>All data</option>
								<option value="1">All data</option>
								<option value="2">All data</option>
								<option value="3">All data</option>
							  </select>
							 </div>
						</form>
						<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#bicoin_chart" aria-expanded="true" aria-controls="bicoin_chart">
							<span class="expend">EXPAND</span>
							<span class="collapse">COLLAPSE</span>
						</button>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="collapse show" id="bicoin_chart">
				  <div class="card card-body">
					<img src="images/chart.jpg" alt="" />
				  </div>
				</div>
			</div>
		</div>
	</div>
</section><!--end chart_trend-->