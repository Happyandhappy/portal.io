<?php 
	defined('BASEPATH') or exit('No direct script access allowed');

	/**
	 * 
	 */
	class Exchange extends Admin_Controller
	{
		
		function __construct()
		{	
			parent::__construct();
			// load model/exchange_model
			$this->load->model('exchange_model');
		}

		public function index(){			
			$this->load->view('admin/exchange/exchange', array('tableData' => $this->exchange_model->get()));
		}

		// delete exchange from table
		public function delete($id){          
            $res = $this->exchange_model->delete($id);          
            if ($res == true)
            	set_alert('success', "Successfully deleted exchange");
           	else
           		set_alert('warning', "Problem deleting exchange");
        	redirect(admin_url('exchange'));
		}

		// add exchange to table
		public function add(){
			if ($this->input->post()) {
                $data            = $this->input->post();                
                $res = $this->exchange_model->add($data['name'], $data['description']);
                if ($res == true){
                	set_alert('success', "Successfully added exchange");                	
                }else{
                	set_alert('warning', "Problem adding exchange");	
                }
                redirect(admin_url('exchange'));
                // $data['message'] = $this->input->post('message', false);
            }
         	$this->load->view('admin/exchange/add');
		}

		// get exchage record from table
		public function get($id){
			$data = $this->exchange_model->get($id);
			echo json_encode($data);
		}

		// update exchange record
		public function edit(){
			if ($this->input->post()){
				$data = $this->input->post();				
				$res = $this->exchange_model->update($data['itemid'], $data['name'], $data['description']);	
				if ($res == true){
					set_alert('success', 'Successfully updated exchange');
					redirect(admin_url('exchange'));
				}
			}
			set_alert('warning', 'Problem updating exchange');
			redirect(admin_url('exchange'));
		}
	}

?>