<?php defined('BASEPATH') or exit('');
    
class Public_www extends Clients_controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->load->view('public/_includes/header');
        $this->load->view('public/home');
        $this->load->view('public/_includes/footer');
    }
    
    public function terms_of_service() {
        $this->load->view('public/_includes/header');
        $this->load->view('public/terms_of_service');
        $this->load->view('public/_includes/footer');
    }
    
    public function privacy_policy() {
        $this->load->view('public/_includes/header');
        $this->load->view('public/privacy_policy');
        $this->load->view('public/_includes/footer');
    }
    
    public function contact_faq() {
        $this->load->view('public/_includes/header');
        $this->load->view('public/contact_faq');
        $this->load->view('public/_includes/footer');
    }
    
}