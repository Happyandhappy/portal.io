<?php defined('BASEPATH') or exit() ; ?>
<section id="reporting">
	<div class="container">
		<div class="head_section heade_section">
			<div class="row head_title">
				<div class="col-sm-12">
						<div class="title">
							<h2>Reporting</h2>
							<div class="right_title">
								Free membership.&nbsp;&nbsp;<button class="sign_in">Sign up</button>
							</div>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="desc text-center">
						<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm">
			</div>
		</div>
	</div>
	<div class="list_chart">
			<div class="container">
			<div class="title_of">
				<img src="images/icon_static.png" alt="" />
				Trade statistics
			</div>
				<div class="chart">
					<div class="head">
						<div class="row">
							<div class="col-sm-3">
								<span class="title_chart">Value by currency</span>
							</div>
							<div class="col-sm-9">
								<div class="eye tb">
									<ul class="tb-cell">
										<li><span class="status tus2"> </span>BTC</li>
										<li><span class="status tus3"> </span>ADA</li>
										<li><span class="status tus4"> </span>ETH</li>
										<li><span class="status tus6"> </span>IOT</li>
										<li><span class="status tus7"> </span>MCO</li>
										<li><span class="status tus8"> </span>QSP</li>
										<li><span class="status tus9"> </span>VEN</li>
										<li><span class="status special"> </span>AUD</li>
									</ul>
									<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#valueby_curcy" aria-expanded="true" aria-controls="valueby_curcy">
										<span class="expend">EXPAND</span>
										<span class="collapse">COLLAPSE</span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="collapse show" id="valueby_curcy">
						  <div class="card card-body">
							<img src="images/currency_chart.jpg" alt="" />
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
								<span class="title_chart">Trading volume by day</span>
							</div>
							<div class="col-sm-9">
								<div class="eye tb">
									<ul class="tb-cell">
										<li><span class="status tus2"> </span>Buy volume A$</li>
										<li><span class="status tus8"> </span>Buy volume A$</li>
									</ul>
									<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#volumn_chart" aria-expanded="true" aria-controls="volumn_chart">
										<span class="expend">EXPAND</span>
										<span class="collapse">COLLAPSE</span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="collapse show" id="volumn_chart">
						  <div class="card card-body">
							<img src="images/volumn_chart.jpg" alt="" />
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="list_chart">
		<div class="container"><!--hide --> 
			<div class="title_of">
				<i class="fa fa-align-justify"></i>
				Trade list
			</div>
			<div class="chart">
				<div class="head">
					<div class="row">
						<div class="col-sm-3">
							<span class="title_chart">Trades</span>
						</div>
						<div class="col-sm-5">
							<img src="images/bar_chart.jpg" alt="" />
						</div>
						<div class="col-sm-4">
							<div class="eye tb">
								<ul class="tb-cell">
									<li><span class="status tus2"> </span>Deposit: <span class="value">A$ 290.00</span></li>
								</ul>
								<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#trades" aria-expanded="false" aria-controls="trades">
									<span class="expend">EXPAND</span>
									<span class="collapse">COLLAPSE</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="collapse hide" id="trades">
					  <div class="card card-body">
						<img src="images/volumn_chart.jpg" alt="" />
					  </div>
					</div>
				</div>
			</div>
		</div>
		<div class="container"><!--hide --> 
			<div class="chart">
				<div class="head">
					<div class="row">
						<div class="col-sm-3">
							<span class="title_chart">Trading fees</span>
						</div>
						<div class="col-sm-5">
							<img src="images/bar_chart2.jpg" alt="" />
						</div>
						<div class="col-sm-4">
							<div class="eye tb">
								<ul class="tb-cell">
									<li><span class="status tus8"> </span>Paid: <span class="value">A$ 2.00</span></li>
								</ul>
								<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#trades_fee" aria-expanded="false" aria-controls="trades_fee">
									<span class="expend">EXPAND</span>
									<span class="collapse">COLLAPSE</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="collapse hide" id="trades_fee">
					  <div class="card card-body">
						<img src="images/volumn_chart.jpg" alt="" />
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="list_chart">
		<div class="container"><!--hide --> 
			<div class="title_of">
				<i class="fa fa-database"></i>
				Current balance
			</div>
			<div class="chart">
				<div class="head">
					<div class="row">
						<div class="col-sm-3">
							<span class="title_chart">Balance by exchange</span>
						</div>
						<div class="col-sm-6 text-center">
							<span class="up"><i class="fa fa-caret-up"></i>&nbsp;&nbsp; +7% over 30 days</span>
						</div>
						<div class="col-sm-3">
							<div class="eye tb">
								<ul class="tb-cell">
									<li><i class="fa fa-bitcoin"></i>&nbsp;&nbsp; BTC: <span class="value">03.70</span></li>
								</ul>
								<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#balances_ex" aria-expanded="false" aria-controls="balances_ex">
									<span class="expend">EXPAND</span>
									<span class="collapse">COLLAPSE</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="collapse hide" id="balances_ex">
					  <div class="card card-body">
						<img src="images/volumn_chart.jpg" alt="" />
					  </div>
					</div>
				</div>
			</div>
		</div>
		<div class="container"><!--hide --> 
			<div class="chart">
				<div class="head">
					<div class="row">
						<div class="col-sm-3">
							<span class="title_chart">Value by currency</span>
						</div>
						<div class="col-sm-6 text-center">
							<span class="up"><i class="fa fa-caret-up"></i>&nbsp;&nbsp; Trading QSP adds 0.02%</span>
						</div>
						<div class="col-sm-3">
							<div class="eye tb">
								<ul class="tb-cell">
									<li><img class="qsp_logo" src="images/qsp_icon.jpg" alt="" />&nbsp;&nbsp; QSP: <span class="value">04.99</span></li>
								</ul>
								<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#balances_cur" aria-expanded="false" aria-controls="balances_cur">
									<span class="expend">EXPAND</span>
									<span class="collapse">COLLAPSE</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="collapse hide" id="balances_cur">
					  <div class="card card-body">
						<img src="images/volumn_chart.jpg" alt="" />
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="list_chart">
		<div class="container"><!--hide --> 
			<div class="title_of">
				<img src="images/icon_over.png" alt="" />
				Overviews
			</div>
			<div class="chart">
				<div class="head">
					<div class="row">
						<div class="col-sm-3">
							<span class="title_chart">Double entry list</span>
						</div>
						<div class="col-sm-9">
							<div class="eye tb">
								<a href="#" class="view_all tb-cell">View list</a>
								<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#double_list" aria-expanded="false" aria-controls="double_list">
									<span class="expend">EXPAND</span>
									<span class="collapse">COLLAPSE</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="collapse hide" id="double_list">
					  <div class="card card-body">
						<img src="images/volumn_chart.jpg" alt="" />
					  </div>
					</div>
				</div>
			</div>
		</div>
		<div class="container"><!--hide --> 
			<div class="chart">
				<div class="head">
					<div class="row">
						<div class="col-sm-3">
							<span class="title_chart">Realised/Unrealised gains</span>
						</div>
						<div class="col-sm-9">
							<div class="eye tb">
								<a href="#" class="view_all tb-cell">View list</a>
								<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#realised" aria-expanded="false" aria-controls="realised">
									<span class="expend">EXPAND</span>
									<span class="collapse">COLLAPSE</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="collapse hide" id="realised">
					  <div class="card card-body">
						<img src="images/volumn_chart.jpg" alt="" />
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!--end reporting-->