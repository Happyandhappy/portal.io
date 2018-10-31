<?php defined('BASEPATH') or exit() ; ?>
<section id="enter_coin">
		<div class="container">
			<div class="row head">
				<div class="col-sm-2"></div>
				<div class="col-sm-8 text-center mb-40">
					<div class="logo_section"><img class="logo_2" src="images/logo_entercoin.png"/>Exchange Data</div>
					<p>Select the method to connect your data (Only CSV uploads are currently available).</p>
				</div>
				<div class="col-sm-2"></div>
				<div class="col-sm-12">
					<div class="coinenter_btn text-center">
						<!--
						<button type="button" class="btn btn-light">Manual</button>
						<button type="button" class="btn btn-white">CSV</button>
						-->                        
						<div class="tab-content" id="pills-tabContent">
						  <div class="tab-pane fade" id="pills-manual" role="tabpanel" aria-labelledby="pills-manual-tab">
						  		<div class="row">
									<div class="col-sm-12">
										<div class="tab">
						  					<div class="tab-content">
                                                <h1 style = "color: black">Coming Soon!</h1>
                                                <br>
						  						<p>We are sorry, but we are still currently working on integrating API&apos;s and will make this available as soon as we can!</p>
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
	                                            <h1 style = "color:black">Select client</h1>
                                                <div class="right_title das_title">
                                                <button>Manage Clients &nbsp; <i class="fa fa-angle-double-right"></i></button>
                                                </div>
                                                <br><br>
                                                <div class="alert alert-danger" role="alert" id="client_alert" style="display: none;">Please select one of clients</div>
                                                <div class="col-sm-8 col-md-12">                    
						                            <div class="select_control">
                                                        <i class="fa fa-caret-down"></i>
				                                     	<select class="custom-select" id="clients_list">
						                                    <option selected value="">Select Client</option>
						                                    <?php 
						                                    	foreach ($clients as $value) {
						                                    		echo "<option value='".$value['id']."'>".$value['firstname']." ".$value['lastname']."</option>";
						                                    	}
						                                    ?>                                  
				                                    	 </select>
                                                    </div>						                            
				                               	</div>
											</ul>
                                            <br><br>
                                            <hr>
                                            <ul class="nav nav-tabs text-center">
                                            <br>
                                            <h1 style = "color:black">Select Exchange</h1>
                                                <br><br>
                                                <div class="alert alert-danger" role="alert" id="exchange_alert" style="display: none;">Please select one of exchanges</div>
                                                <div class="col-sm-8 col-md-12">
                                                    <form class="select_tag" action="" name="" method="">
							                            <div class="select_control">
                                                            <i class="fa fa-caret-down"></i>
							                                     <select class="custom-select" id="exchange_list"> 	
								                                    <option selected value="">Select Exchange</option>
								                                    <?php                                   	
								                                    	foreach ($exchanges as $value) {
								                     						echo "<option value='" . $value->name."'>". $value->name . "</option>";
								                                    	}
								                                    ?>                                  
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
                                                <h1 style = "color:black">Upload your file!</h1>
                                                <br><br>
                                                <?php
												  	if (strlen($message)) {
												  		if ($message == 'success') {
												  			?><div class="alert alert-success" role="alert">Thank you, your CSV file has been uploaded</div><?php
												  		}else if ($message == 'failed'){
												  			?><div class="alert alert-danger" role="alert">There was an error uploading your file, please try again</div><?php
												  		}
												  	}
										  		?>
								                <div id="home1" class="tab-pane fade">
								                    <form class="upload" action="<?php echo base_url().'?/Upload_ExchangeCSV/upload'; ?>" enctype="multipart/form-data" method="post" id="form1">
												        <input type="file" name="file" id="file" class="inputfile" />
											        	<input type="hidden" name="exchange" value="">
								                        <input type="hidden" name="client" value="">
								                        <input type="hidden" name="history" value="transferHistory">
												        <label for="file">Click here to select your file</label>
                                                        <button>Upload</button>
												    </form>
                                                    <p>Don&apos;t worry if you have overlapping histories, we will remove duplicate entries for you!</p>
                                                </div>

								                <div id="menu1" class="tab-pane in active">
								                    <form class="upload" action="<?php echo base_url().'?/Upload_ExchangeCSV/upload'; ?>" enctype="multipart/form-data" method="post" id="form2">
								                        <input type="file" name="file" class="inputfile" />
								                        <input type="hidden" name="exchange" value="">
								                        <input type="hidden" name="history" value="tradeHistory">
								                        <input type="hidden" name="client" value="">
				                                        <label for="file">Click here to select your file</label>
                                                        <button>Upload</button>
												    </form>
                                                    <p>Don&apos;t worry if you have overlapping histories, we will remove duplicate entries for you!</p>
												</div>

                                                <div id="menu2" class="tab-pane fade">

													<form class="upload" action="<?php echo base_url().'?/Upload_ExchangeCSV/upload'; ?>" enctype="multipart/form-data" method="post" id="form3">
														<input type="hidden" name="exchange" value="">
								                        <input type="hidden" name="client" value="">
								                        <input type="hidden" name="history" value="bankHistory">
														<input type="file" name="file" id="file" class="inputfile" />
														<label for="file">Click here to select your file</label>
														<button>Upload</button>
													</form>
													<p>Don&apos;t worry if you have overlapping histories, we will remove duplicate entries for you!</p>
								                </div>
                                                <br><br>

                                                <div id="menu3" class="tab-pane fade">
												    <form class="upload" action="<?php echo base_url().'?/Upload_ExchangeCSV/upload'; ?>" enctype="multipart/form-data" method="post" id="form4">
												    	<input type="hidden" name="exchange" value="">
								                        <input type="hidden" name="client" value="">
								                        <input type="hidden" name="history" value="tradeHistory">
												   		<input type="file" name="file" id="file" class="inputfile" />
												   		<label for="file">Choose a file</label>
													   	<button>Upload</button>
												    </form>
												</div>
											</div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
			<!--
			<div class="row">
				<div class="col-sm-12">
					<div class="tab">
						<ul class="nav nav-tabs text-center">
						  <li><a data-toggle="tab" href="#home1">Bulk CSV</a></li>
						  <li><a class="active" data-toggle="tab" href="#menu1">Exchange CSV </a></li>
						  <li><a data-toggle="tab" href="#menu2">Exchange API </a></li>
						  <li><a data-toggle="tab" href="#menu3">Wallet </a></li>
						</ul>

						<div class="tab-content">
						  <div id="home1" class="tab-pane fade">
							<form class="upload">
								<input type="file" name="file" id="file" class="inputfile" />
								<label for="file">Choose file</label>
								<button>Upload</button>
							</form>
							<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
						  </div>
						  <div id="menu1" class="tab-pane in active">
							<form class="upload">
								<input type="file" name="file" id="file" class="inputfile" />
								<label for="file">Choose a file</label>
								<button>Upload</button>
							</form>
							<p>Lorem ipsum dolor sit amet, no atomorum periculis sea, ad mazim explicari pri. Te nam repudiare vituperatoribus clita vocent eum, duo in aperiam volutpat.</p>
							</div>
						  <div id="menu2" class="tab-pane fade">
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
						  </div>
						</div>
					</div>
				</div>
			</div>
			--> 
			<div class="content">
			</div>
        </div>          
	</section><!--end upload_data-->
	<script type="text/javascript">
		$('#exchange_list').change(function(){
			console.log($(this).val());
			$('input[name="exchange"]').val($(this).val());
		});

		$('#clients_list').change(function(eve){
			// console.log($('input[name="client"]'));
			// console.log($(this).val());
			$('input[name="client"]').val($(this).val());
		});		
		

		$(document).ready(function(){
			$('input[name="client"]').val('');
			$('input[name="exchange"]').val('');
			for (var i = 1; i < 4; i++){
				$('#form' + i).submit(function(e) {
					$('#exchange_alert').css('display','none');
					$('#client_alert').css('display','none');
					if ($('input[name="exchange"]').val() === '') {
						$('#exchange_alert').css('display','block');
						$("html, body").animate({ scrollTop: $(document).height()/4 }, "slow");
						e.preventDefault();
					}

					if ($('input[name="client"]').val() === ''){				
						$("html, body").animate({ scrollTop: $(document).height()/4 }, "slow");
						$('#client_alert').css('display','block');
						e.preventDefault();	
					}
				});
			}

		});
	</script>