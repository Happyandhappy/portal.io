<?php init_head();?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<div class="_buttons">
							<a href="#" class="btn btn-info pull-left" onclick="add_exchange(); return false;" data-toggle="modal" data-target="#exchange_item_modal">
								<?php echo _l('new exchange name'); ?>									
							</a>
						</div>
						<div class="clearfix"></div>

						<hr class="hr-panel-heading" />
						<div class="row">
							<div class="col-md-12">								
								<?php $this->load->view('admin/exchange/_table', array('tableData'=>$tableData)); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/exchange/modal'); ?>
<?php init_tail(); ?>

<script type="text/javascript">
  $(document).ready(()=>{
      $(".edit-title").addClass('hide');
      $(".add-title").removeClass('hide');
      $('#table').DataTable();
	  setTimeout(()=>{
	  	$("#table").removeClass('hide');
	 	$('#table_wrapper').removeClass('table-loading');
	  }, 1000);
  });

 var add_exchange = function(){
	$(".edit-title").addClass('hide');
	$(".add-title").removeClass('hide');
	$("#exchange_form").attr('action','<?php echo admin_url('exchange/add'); ?>');

	$('#itemid').val('');
	$('#name').val('');
	$('#description').val('');
 }

 var edit_exchange = function(id){
      $(".add-title").addClass('hide');
      $(".edit-title").removeClass('hide');
      $("#exchange_form").attr('action','<?php echo admin_url('exchange/edit'); ?>' + "/" + id);
      $.ajax({
      	url : "<?php echo admin_url('exchange/get'); ?>" + "/" + id,
      	data : {
      		id : id
      	},
      	success : function(res){
      		console.log(res);
      		var data = JSON.parse(res);
      		if (data.length > 0){
      			$('#itemid').val(data[0]['id']);
      			$('#name').val(data[0]['name']);
      			$('#description').val(data[0]['description']);
      		}
      	}
      });
 }

</script>
