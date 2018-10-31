<?php defined('BASEPATH') or exit() ; ?>

<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<!--<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootpopup@1.5.1/bootpopup.min.js"></script>

<section id="dashboard">
	<div class="container">

		<!-- header description -->
		<div class="head_section heade_section">
			<div class="row head_title">
				<div class="col-sm-12">
						<div class="title">
							<h2>Manage Clients</h2>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="desc text-center">
						<p>View, add or edit your clients here.</p>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
		
		
		<!-- search and nav -->
		<div class=row>
			<div class="col-sm-2">
				<div class="execute tb">
					<button type="button" class="form-control exe tb-cell" id="btn-add-client" onclick="add_client()" style="position: relative; top: -20px; left: -20px;">Add a Client&nbsp; <i class="fa fa-angle-double-right"></i></button>
                </div>
			</div>
			<!--<div class="col-sm-7">-->
				
			<!--</div>-->
			<!--<div class="col-sm-3">-->
			<!--	<div class="input-group mb-3">-->
			<!--	<div class="input-group-prepend">-->
			<!--	<span class="input-group-text" id="basic-addon1">&#128269;</span>-->
			<!--	</div>-->
			<!--	<input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon1">-->
			<!--	</div>			-->
			<!--</div>			-->
		</div>		

		<div class=row>
			<div class=col-sm-12>
					<table id="example" class="display" style="width:100%">
				        <thead>
				            <tr>
					              <th scope="col">ID</th>
					              <th scope="col">No.</th>
							      <th scope="col">First Name</th>
							      <th scope="col">Last Name</th>
							      <th scope="col">Email</th>
							      <th scope="col">Phone</th>
							      <th scope="col">Active</th>
							      <th scope="col">Options</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
								  <th scope="col">ID</th>
								  <th scope="col">No.</th>
							      <th scope="col">First Name</th>
							      <th scope="col">Last Name</th>
							      <th scope="col">Email</th>
							      <th scope="col">Phone</th>
							      <th scope="col">Active</th>
							      <th scope="col">Options</th>
				            </tr>
				        </tfoot>
				    </table>
				    
				    <script>
					
					$(document).ready(function() {
					    fetch_client_data();
				    
						//   $('a.add-client-button').click(function(){
						//     var id =  $(this).data("id");
						//     alert(id);
						// });
					});
					    
				    </script>
    		</div>
		</div>

		
		
		<!-- table -->
		<!--<div class=row>-->

		<!--	<table id="client-management-table" class="table">-->
		<!--	  <caption>Products Information</caption>-->
		<!--	  <thead style="background-color: #1d48a1; color: white;">-->
		<!--	    <tr>-->
		<!--	      <th scope="col">No.</th>-->
		<!--	      <th scope="col">First Name</th>-->
		<!--	      <th scope="col">Last Name</th>-->
		<!--	      <th scope="col">Email</th>-->
		<!--	      <th scope="col">Phone</th>-->
		<!--	      <th scope="col">Active</th>-->
		<!--	      <th scope="col">Options</th>-->
		<!--	    </tr>-->
		<!--	  </thead>-->
		<!--	  <tbody>-->
		<!--	    <tr>-->
		<!--	      <th scope="row">1</th>-->
		<!--	      <td style="color: #009fff;">Chris</td>-->
		<!--	      <td style="color: #ff8300;">Goder</td>-->
		<!--	      <td style="color: #848484;">chris@centralinfo.com.au</td>-->
		<!--	      <td style="color: #9a9703;">+60 1234 1234</td>-->
		<!--	      <td>switch</td>-->
		<!--	      <td><span class="label" style="cursor: pointer;color:#00bb3b;">Edit</span>|<span class="label" style="cursor: pointer;color:red;">Delete</span></td>-->

		<!--	    </tr>-->
			    
		<!--	    <tr>-->
		<!--	      <th scope="row">2</th>-->
		<!--	      <td style="color: #009fff;">Chris</td>-->
		<!--	      <td style="color: #ff8300;">Goder</td>-->
		<!--	      <td style="color: #848484;">chris@centralinfo.com.au</td>-->
		<!--	      <td style="color: #9a9703;">+60 1234 1234</td>-->
		<!--	      <td>switch</td>-->
		<!--	      <td><span class="label" style="cursor: pointer;color:#00bb3b;">Edit</span>|<span class="label" style="cursor: pointer;color:red;">Delete</span></td>-->

		<!--	    </tr>-->
		<!--	  </tbody>-->
		<!--	  <tfoot style="background-color: #1d48a1; color: white;">-->
		<!--	    <tr>-->
		<!--	      <th scope="col">No.</th>-->
		<!--	      <th scope="col">First Name</th>-->
		<!--	      <th scope="col">Last Name</th>-->
		<!--	      <th scope="col">Email</th>-->
		<!--	      <th scope="col">Phone</th>-->
		<!--	      <th scope="col">Active</th>-->
		<!--	      <th scope="col">Options</th>-->
		<!--	    </tr>-->
		<!--	  </tfoot>-->
		<!--	</table>-->
			
		<!--</div>-->
		
	</div>
</section>

<script>
	
	function fetch_client_data() {
		
    
		$('#example').DataTable({
			"columnDefs": [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            }],
			"ajax": '<?php echo base_url(); ?>?/Private_www/fetch_client?'
		});
	}
	function delete_client(clientid) {
		bootpopup.confirm(
			"Are you sure to delete?", 
			"Delete Client", 
			function(ans) { 
				if(ans == true) {
					$.post("<?php echo base_url(); ?>?/Private_www/delete_client?'",
			    	{
			    		clientid: clientid
			    	}, 
			    	function(data) {
					  if(data.success == false) {
					  	alert(data.message);
					  } else {
					  	location.reload();
					  }
					  
					},"json");
				}
			}
		);
	}
	function edit_client(clientid, firstname, lastname, email, phonenumber) {
		
		bootpopup({
	    title: "Edit Client",
	    //size: "large",
	    showclose: false,
	    size_labels: "col-sm-3",
	    size_inputs: "col-sm-12",
	    content: [
	        { p: {text: "Click on a field to edit your client's data:"}},
	        
	        { input: {type: "text", 	label: "First Name",	name: "firstname",	id: "firstname",	placeholder: "", value: firstname}},
	        { input: {type: "text", 	label: "Last Name",		name: "lastname",	id: "lastname", 	placeholder: "", value: lastname}},
	        { input: {type: "email",	label: "Email",			name: "email",		id: "email",		placeholder: "", value: email}},
	        { input: {type: "tel",		label: "Phone",	name: "phonenumber", id: "phonenumber", placeholder: "", value: phonenumber}},

	        ],
	    before: function(window) { 
	    	//alert("Before"); 
	    	
	    },
	    dismiss: function(event) { 
	    	//alert("Dismiss"); 
	    },
	    cancel: function(data, array, event) { 
	    	//alert("Cancel"); 
	    },
	    ok: function(data, array, event) {
	    	$.post("<?php echo base_url(); ?>?/Private_www/update_client?'",
	    	{
	    		clientid: clientid,
	    		firstname: data.firstname,
	    		lastname: data.lastname,
	    		email: data.email,
	    		phonenumber: data.phonenumber,
	    	}, 
	    	function(data) {
			  if(data.success == false) {
			  	alert(data.message);
			  } else {
			  	location.reload();
			  }
			  
			},"json");
	    	
	    },
	    complete: function() { 
	    	//alert("Complete"); 
	    },
	    });
	}
	function add_client() {
		bootpopup({
	    title: "Add Client",
	    //size: "large",
	    showclose: false,
	    size_labels: "col-sm-3",
	    size_inputs: "col-sm-12",
	    content: [
	        { p: {text: "Please fill in your new client's details:"}},
	        { input: {type: "text", 	label: "First Name",	name: "firstname",	id: "firstname",	placeholder: "", value: ""}},
	        { input: {type: "text", 	label: "Last Name",		name: "lastname",	id: "lastname", 	placeholder: "", value: ""}},
	        { input: {type: "email",	label: "Email",			name: "email",		id: "email",		placeholder: "", value: ""}},
	        { input: {type: "tel",		label: "Phone",			name: "phonenumber", id: "phonenumber", placeholder: "", value: ""}},
	        
	        ],
	    before: function(window) { 
	    	//alert("Before"); 
	    },
	    dismiss: function(event) { 
	    	//alert("Dismiss"); 
	    },
	    cancel: function(data, array, event) { 
	    	//alert("Cancel"); 
	    },
	    ok: function(data, array, event) { 
	    	$.post("<?php echo base_url(); ?>?/Private_www/add_client?'",
	    	{
	    		firstname: data.firstname,
	    		lastname: data.lastname,
	    		email: data.email,
	    		phonenumber: data.phonenumber,
	    	}, 
	    	function(data) {
			  if(data.success == false) {
			  	alert(data.message);
			  } else {
			  	location.reload();
			  }
			  
			},"json");
	    	
	    },
	    complete: function() { 
	    	//alert("Complete"); 
	    },
	    });
	}
</script>