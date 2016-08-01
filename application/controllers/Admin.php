<?php

class Admin extends CI_Controller {

	public function __construct(){
                        parent::__construct();
                        $this->load->helper('html');
                        $this->load->helper('url_helper');
    }

    public function index(){
                        
	    $data['title'] = 'Admin Dashboard';
	    $data['is_admin'] = true;
	    
	    $this->load->view('templates/header', $data);
	    $this->load->view('admin/dashboard', $data);
	    $this->load->view('templates/footer');
	}


}