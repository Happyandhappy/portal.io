<?php defined('BASEPATH') or exit() ;?>
<section id="enter_coin">
		<div class="container">
			<div class="row head">
				<div class="col-sm-2"></div>
				<div class="col-sm-8 text-center mb-40">
					<div class="logo_section"><img class="logo_2" src="images/logo_entercoin.png" alt="" />Exchange Data</div>
					<p>Select the method to connect your data (Only CSV uploads are currently available).</p>
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
						    <a class="nav-link " id="pills-manual-tab" data-toggle="pill" href="#pills-manual" role="tab" aria-controls="pills-manual" aria-selected="false">API</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link active" id="pills-csv-tab" data-toggle="pill" href="#pills-csv" role="tab" aria-controls="pills-csv"  aria-selected="true">CSV</a>
						  </li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
  						  	<div class="tab-pane fade" id="pills-manual" role="tabpanel" aria-labelledby="pills-manual-tab">
						  		<div class="row">
									<div class="col-sm-12">
										<div class="tab">
						  					<div class="tab-content">
                                                <h1 style = "color: black">Coming Soon!</h1>
                                                <br>
						  						<p>We are sorry, but we are still currently working on integrating API's and will make this available as soon as we can!</p>
						  					</div>
										</div>
									</div>
								</div>
						  	</div>
						  	<div class="tab-pane fade show active" id="pills-csv" role="tabpanel" aria-labelledby="pills-csv-tab">
						  		<div class="row">
									<div class="col-sm-12">
										<div class="tab">											
											<ul class="nav nav-tabs text-center">
												<br>
	                                            <h1 style = "color:black">Select exchange</h1>
                                                <br><br>
                                                <div class="alert alert-danger" role="alert" id="exchange_alert" style="display: none;">Please select one of exchanges</div>
                                                <div class="col-sm-8 col-md-12">                    
							                            <div class="select_control">	
                                                            <i class="fa fa-caret-down"></i>
					                                     	<select class="custom-select" id="exchange_list" required>
							                                    <option selected>Select Exchange</option>
							                                    <?php
							                                    	foreach ($exchanges as $value) {
							                                    		echo "<option value='$value->name'>".$value->name."</option>";
							                                    	}
							                                     ?>
							                                    <!-- <option value="1">Binance</option>
							                                    <option value="2">Huobi</option>
							                                    <option value="3">GDAX</option> -->
					                                     	</select>
                                                        </div>
					                              	</form>
				                               	</div>
											</ul>
                                            <br><br>
                                        	<hr>
                                        	<ul class="nav nav-tabs text-center">
                                                <h1 style = "color:black">Select history type</h1>
                                                <br><br>
								                <li><a data-toggle="tab" href="#home1">Transfer History</a></li>
                                                <li><a class="active" data-toggle="tab" href="#menu1">Trade History</a></li>
				                                <li><a data-toggle="tab" href="#menu2">Bank History</a></li>
											</ul>
                                            <br><br>
                                            <hr>
											

											<div class="tab-content">
											  <!--<div id="home1" class="tab-pane fade">
												<form class="upload">
													<input type="file" name="file" id="file" class="inputfile" />
													<label for="file">Choose file</label>
													<button>Upload</button>
												</form>
												<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
											  </div>-->
											  	<h1 style = "color:black">Upload your file!</h1>
                                            	<br><br>                                            	
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
													<form class="upload" name="frmExchangeCSV" enctype="multipart/form-data" method="post" action="<?php echo base_url().'?/Upload_ExchangeCSV/upload'; ?>">
														<input type="hidden" name="exchange" value="">
														<input type="hidden" name="history" value="tradeHistory">
														<input type="file" name="file" id="file" class="inputfile" />
														<label for="file">Choose a file</label>
														<button>Upload</button>
													</form>
													<p>Please select an Exchange CSV file for import.</p>
												</div>

												<div id="home1" class="tab-pane fade">
												  	<?php
												  	if (strlen($message)) {
												  		if ($message == 'success') {
												  			?><div class="alert alert-success" role="alert">Thank you, your CSV file has been uploaded</div><?php
												  		}else if ($message == 'failed'){
												  			?><div class="alert alert-danger" role="alert">There was an error uploading your file, please try again</div><?php
												  		}
												  	}
												  	?>
													<form class="upload" name="frmExchangeCSV" enctype="multipart/form-data" method="post" action="<?php echo base_url().'?/Upload_ExchangeCSV/upload'; ?>">
														<input type="hidden" name="exchange" value="">
														<input type="hidden" name="history" value="transferHistory">
														<input type="file" name="file" id="file" class="inputfile" />
														<label for="file">Choose a file</label>
														<button>Upload</button>
													</form>
													<p>Please select an Exchange CSV file for import.</p>
												</div>

												<div id="menu2" class="tab-pane fade">
												  	<?php
												  	if (strlen($message)) {
												  		if ($message == 'success') {
												  			?><div class="alert alert-success" role="alert">Thank you, your CSV file has been uploaded</div><?php
												  		}else if ($message == 'failed'){
												  			?><div class="alert alert-danger" role="alert">There was an error uploading your file, please try again</div><?php
												  		}
												  	}
												  	?>
													<form class="upload" name="frmExchangeCSV" enctype="multipart/form-data" method="post" action="<?php echo base_url().'?/Upload_ExchangeCSV/upload'; ?>">
														<input type="hidden" name="exchange" value="">
														<input type="hidden" name="history" value="bankHistory">
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
	<script type="text/javascript">
		$('#exchange_list').change(function(eve){
			$('input[name="exchange"]').val($(this).val());
		});

		$('form[name="frmExchangeCSV"]').submit((e) => {			
			if ($('input[name="exchange"]').val() === '') {
				$('#exchange_alert').css('display','block');
				e.preventDefault();
			}			
		})
	</script>