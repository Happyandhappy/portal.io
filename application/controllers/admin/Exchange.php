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
			// $this->load->model('projects_model');
		}

		public function index(id=''){
			$this->list_tasks($id);
		}

		public function list_tasks($id = ''){
			close_setup_menu();

			$data['custom_view'] = $this->input->get('custom_view') ? $this->input->get('custom_view') : '';
			$data['task_id'] = $id;
		}
	}

?>