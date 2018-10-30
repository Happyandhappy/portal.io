<?php defined('BASEPATH') or exit('');
    
class Private_www extends Clients_controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add_client() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/management/add_client');
    }
    
    public function update_client() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/management/update_client');
    }
    
    public function delete_client() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/management/delete_client');
    }
    
    public function fetch_client() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/management/fetch_client');
    }
    
    public function mng_accountant() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/_includes/header');
        $this->load->view('private/management/mng_accountant');
        $this->load->view('private/_includes/footer');
    }
    
    public function mng_client() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/_includes/header');
        $this->load->view('private/management/mng_client');
        $this->load->view('private/_includes/footer');
    }
    
    public function dashboard() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/_includes/header');
        $this->load->view('private/dashboard');
        $this->load->view('private/_includes/footer');
    }
    
    public function reporting() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/_includes/header');
        $this->load->view('private/reporting');
        $this->load->view('private/_includes/footer');
    }
    
    public function enter_coins($message="") {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        
        $data['exchanges'] = $this->exchange_model->get();
        $data['message'] = $message;
        //$this->load->view('private/_includes/header');        
        $this->load->view('private/_includes/header1');
        // $this->load->view('private/_includes/content_header');
        $this->load->view('private/enter_coins',$data);
        $this->load->view('private/_includes/footer1');
    }
    
    public function charts_trends() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/_includes/header');
        $this->load->view('private/charts_trends');
        $this->load->view('private/_includes/footer');
    }
    
    public function tax_report() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/_includes/header');
        $this->load->view('private/tax_report');
        $this->load->view('private/_includes/footer');
    }
    
    public function customer_support() {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->view('private/_includes/header');
        $this->load->view('private/customer_support');
        $this->load->view('private/_includes/footer');
    }
    
}