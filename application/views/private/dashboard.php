<?php defined('BASEPATH') or exit() ; ?>
<section id="dashboard">
	<div class="container">
		<div class="head_section heade_section">
			<div class="row head_title">
				<div class="col-sm-12">
						<div class="title">
							<h2> Dashboard preview </h2>
							<div class="right_title das_title">
								<button>Link your coins &nbsp; <i class="fa fa-angle-double-right"></i></button>
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
		<div class="chart">
			<div class="head">
				<div class="row">
					<div class="col-sm-3">
						<span class="title_chart">Currency value</span>
					</div>
					<div class="col-sm-9">
						<div class="eye tb">
							<ul class="tb-cell">
								<li><span class="status tus1"> </span>BTC Value: <span class="value">A$ 4,206.62</span></li>
							</ul>
							<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
								<span class="expend">EXPAND</span>
								<span class="collapse">COLLAPSE</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="collapse show" id="collapseExample">
				  <div class="card card-body">
					<img src="images/chart_dash.jpg" alt="" />
				  </div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="chart">
			<div class="head">
				<div class="row">
					<div class="col-sm-3">
						<span class="title_chart">Exchange value</span>
					</div>
					<div class="col-sm-9">
						<div class="eye tb">
							<ul class="tb-cell">
								<li><span class="status tus1"> </span>BTC Value: <span class="value">A$ 4,206.62</span></li>
							</ul>
							<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#exchange" aria-expanded="false" aria-controls="exchange">
								<span class="expend">EXPAND</span>
								<span class="collapse">COLLAPSE</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="collapse hide" id="exchange">
				  <div class="card card-body">
					<img src="images/chart_dash.jpg" alt="" />
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="chart">
			<div class="head">
				<div class="row">
					<div class="col-sm-3">
						<span class="title_chart">Value by day</span>
					</div>
					<div class="col-sm-9">
						<div class="eye tb">
							<ul class="tb-cell">
								<li><span class="status tus2"> </span>Account: <span class="value">A$ 4,206.62</span></li>
								<li><span class="status tus10"> </span>Coins:  <span class="value">BTC 0.74</span></li>
								<li><span class="status tus9"> </span>Currencies: <span class="value">A$ 0.00</span></li>
							</ul>
							<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#valuebyday" aria-expanded="true" aria-controls="valuebyday">
								<span class="expend">EXPAND</span>
								<span class="collapse">COLLAPSE</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="collapse show" id="valuebyday">
				  <div class="card card-body">
					<img src="images/value_byday_chart.jpg" alt="" />
				  </div>
				</div>
			</div>
		</div>
	</div>
</section><!--end dashboard-->