<?php defined('BASEPATH') or exit() ; ?>
<section id="enter_coin">
		<div class="container">
			<div class="row head">
				<div class="col-sm-2"></div>
				<div class="col-sm-8 text-center mb-40">
					<div class="logo_section"><img class="logo_2" src="images/logo_entercoin.png" alt="" /> Enter coins</div>
					<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
				</div>
				<div class="col-sm-2"></div>
				<div class="col-sm-12">
					<div class="coinenter_btn text-center">
						<!--
						<button type="button" class="btn btn-light">Manual</button>
						<button type="button" class="btn btn-white">CSV</button>
						-->
						<ul class="nav nav-pills" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <!--<a class="nav-link " id="pills-manual-tab" data-toggle="pill" href="#pills-manual" role="tab" aria-controls="pills-manual" aria-selected="false">Manual</a>
						  </li><li class="nav-item">-->
						    <a class="nav-link active" id="pills-csv-tab" data-toggle="pill" href="#pills-csv" role="tab" aria-controls="pills-csv"  aria-selected="true">CSV</a>
						  </li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
						  <!--<div class="tab-pane fade" id="pills-manual" role="tabpanel" aria-labelledby="pills-manual-tab">
						  		<div class="row">
									<div class="col-sm-12">
										<div class="tab">
											<ul class="nav nav-tabs text-center">
										  	  <li><a class="active" data-toggle="tab" href="#menu1">Manual upload</a></li>
											</ul>
						  					<div class="tab-content">
						  						<form class="upload">
													<input type="file" name="csv_upload" id="csv_upload" class="inputfile" />
													<label for="csv_upload">Choose a file</label>
													<button>Upload</button>
												</form>
						  						<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
						  					</div>
										</div>
									</div>
								</div>
						  </div>-->
						  <div class="tab-pane fade show active" id="pills-csv" role="tabpanel" aria-labelledby="pills-csv-tab">
						  		<div class="row">
									<div class="col-sm-12">
										<div class="tab">
											<ul class="nav nav-tabs text-center">
											  <!--<li><a data-toggle="tab" href="#home1">Bulk CSV</a></li>-->
											  <li><a class="active" data-toggle="tab" href="#menu1">Exchange CSV </a></li>
											  <!--<li><a data-toggle="tab" href="#menu2">Exchange API </a></li>-->
											  <!--<li><a data-toggle="tab" href="#menu3">Wallet </a></li>-->
											</ul>

											<div class="tab-content">
											  <!--<div id="home1" class="tab-pane fade">
												<form class="upload">
													<input type="file" name="file" id="file" class="inputfile" />
													<label for="file">Choose file</label>
													<button>Upload</button>
												</form>
												<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
											  </div>-->
											  <div id="menu1" class="tab-pane in active">
											  	<?php
											  	if (strlen($message)) {
											  		if ($message == 'success') {
											  			?><div class="alert alert-success" role="alert">Thank you, your CSV file has been uploaded</div><?php
											  		}else if ($message == 'failed'){
											  			?><div class="alert alert-danger" role="alert">There was an error uploading your file, please try again</div><?php
											  		}
											  	}
											  	?>
												<form class="upload" name="frmExchangeCSV" id="frmExchangeCSV" enctype="multipart/form-data" method="post" action="<?php echo base_url().'?/Upload_ExchangeCSV/post_btc_market'; ?>">
													<input type="file" name="file" id="file" class="inputfile" />
													<label for="file">Choose a file</label>
													<button>Upload</button>
												</form>
												<p>Please select an Exchange CSV file for import.</p>
												</div>
											  <!--<div id="menu2" class="tab-pane fade">
												<form class="upload">
													<input type="file" name="file" id="file" class="inputfile" />
													<label for="file">Choose a file</label>
													<button>Upload</button>
												</form>
												<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
											  </div>
											  <div id="menu3" class="tab-pane fade">
												<form class="upload">
													<input type="file" name="file" id="file" class="inputfile" />
													<label for="file">Choose a file</label>
													<button>Upload</button>
												</form>
												<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
											  </div>-->
											</div>
										</div>
									</div>
								</div>
						    </div>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
			</div>
		</div>
	</section><!--end chart_trend-->