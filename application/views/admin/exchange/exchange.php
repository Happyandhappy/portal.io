<?php init_head();?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<div class="_buttons">
							<a href="#__todo" data-toggle="modal" class="btn btn-info">
								<?php echo _l('new_todo'); ?>
							</a>
						</div>
						<div class="clearfix"></div>
						<hr class="hr-panel-heading" />
						<div class="row">
							<div class="col-md-6">
								<div class="panel_s events animated fadeIn">
									<div class="panel-body todo-body">
										<h4 class="todo-title warning-bg"><i class="fa fa-warning"></i>
											<?php echo _l('unfinished_todos_title'); ?></h4>
											<ul class="list-unstyled todo unfinished-todos todos-sortable">
												<li class="padding no-todos hide ui-state-disabled">
													<?php echo _l('no_unfinished_todos_found'); ?>
												</li>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 text-center padding">
											<a href="#" class="btn btn-default text-center unfinished-loader"><?php echo _l('load_more'); ?></a>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="panel_s animated fadeIn">
										<div class="panel-body todo-body">
											<h4 class="todo-title info-bg"><i class="fa fa-check"></i>
												<?php echo _l('finished_todos_title'); ?></h4>
												<ul class="list-unstyled todo finished-todos todos-sortable">
													<li class="padding no-todos hide ui-state-disabled">
														<?php echo _l('no_finished_todos_found'); ?>
													</li>
												</ul>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 text-center padding">
												<a href="#" class="btn btn-default text-center finished-loader">
													<?php echo _l('load_more'); ?>
												</a>
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
	</div>
</div>