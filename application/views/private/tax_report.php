<?php defined('BASEPATH') or exit() ; ?>
<!--<section id="tax_report">-->
<section id="chart_trend">
	<div class="container heade_section">
		<div class="row head_title">
			<div class="col-sm-12">
					<div class="title">
						<h2> Tax reports</h2>
						<div class="right_title">
							Prepare yourself for tax time.&nbsp;&nbsp;<button class="sign_in">Sign up</button>
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
	<div class="container"><!--hide --> 
		<div class="chart">
			<div class="head">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-3">
						<span class="title_chart">Generate report</span>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-9 text-right text-md">
						<form class="select_tag" action="" name="" method="">
						<div class="select_control search">
								<input class=" form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
							</div>
							<div class="select_control">
								<i class="fa fa-caret-down"></i>
								<select class="custom-select" id="">
									<option selected>Options</option>
									<option value="1">Options 1</option>
									<option value="2">Options 2</option>
								</select>
							</div>
							<div class="select_control">
								<i class="fa fa-caret-down"></i>
								<select class="custom-select" id="">
									<option selected>Export</option>
									<option value="1">Export json</option>
									<option value="2">Export csv</option>
								</select>
							</div>
						</form>
						<button class="toggle_btn btn btn-default tb-cell" type="button" data-toggle="collapse" data-target="#generate" aria-expanded="false" aria-controls="generate">
							<span class="expend">EXPAND</span>
							<span class="collapse">COLLAPSE</span>
						</button>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="collapse hide" id="generate">
				  <div class="card card-body">
					<img src="images/chart.jpg" alt="" />
				  </div>
				</div>
			</div>
		</div>
	</div>
</section><!--end tax_report-->