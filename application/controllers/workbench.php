<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workbench extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		
		$this->load->helper('url');
		
		$this->load->library("template");
		$this->template->set_layout('workbench/wrapper.php');
	
	}
	
	public function index() {
		
		$this->template->render('workbench/index');
		
	}
	
	public function spreadsheet() {
		$this->template->add_css(APPPATH.'views/common/bootstrap/css/bootstrap.min.css');
		$this->template->add_js('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'); // TODO: make local
		$this->template->add_js(base_url().APPPATH.'views/common/bootstrap/js/bootstrap.min.js'); 
		$this->template->render("workbench/spreadsheet");
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */