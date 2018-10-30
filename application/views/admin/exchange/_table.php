<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
	<table class="table table-exchange dataTable no-footer dtr-inline hide" id="table">
		<thead>
			<tr role="row">
				<th>#</th>
				<th>Name</th>
				<th>CreateAt</th>
				<th>Description</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			if (count($tableData) == 0){
				echo '<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty">No entries found</td></tr>';
			}else{
				$cnt = 0;
				foreach($tableData as $row){?>
				<tr>
					<td><?php echo ++$cnt;?></td>
					<td><?php echo $row->name; ?></td>
					<td><?php echo $row->createdAt; ?></td>
					<td><?php echo $row->description; ?></td>
					<td>
						<a href="#" class="btn btn-default btn-icon" onclick="edit_exchange(<?php echo $row->id; ?>); return false" data-toggle="modal" data-target="#exchange_item_modal">
							<i class="fa fa-pencil-square-o"></i>
						</a>
						
						<a href="<?php echo admin_url('exchange/delete/'.$row->id); ?>" class="btn btn-danger _delete btn-icon"><i class="fa fa-remove"></i></a>
					</td>
				</tr>
		<?php }} ?>
		</tbody>
	</table>
</div>

