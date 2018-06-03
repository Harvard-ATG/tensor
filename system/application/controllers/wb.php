<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wb extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->data = array();

		$this->config->load('local_settings');
		$this->config->load('rdf');
		$this->load->helper('url');
		$this->load->library("template");
		$this->template->set_layout('wrapper.php');

	}

	public function index() {

		header('Location: '.base_url().'wb/pegboard');
		exit;

	}

	public function proxy() {

		$this->load->model('proxy_model');
		if (isset($_REQUEST['data']) && !empty($_REQUEST['data'])) {
			$this->data['results'] = $this->proxy_model->put();
		} else {
			$this->data['results'] = $this->proxy_model->get();
		}
		$this->load->view('proxy', $this->data);

	}

	public function parsers($only_installable_systems=false) {

		$parsers = array();
		$path = FCPATH.'parsers';
		if (!file_exists($path)) die ('{"error":"No parsers folder in the Tensor root folder"}');
		$ffs = scandir($path);
    	foreach ($ffs as $ff){
        	if($ff != '.' && $ff != '..' && is_dir($path.'/'.$ff)) {
            	$parsers[] = $ff;
      	 	}
    	}
    	echo json_encode($parsers);

	}

	public function pegboard() {

		$this->data['title'] = 'Tensor';
		$this->data['proxy_url'] = base_url().strtolower(get_class()).'/proxy';

		$this->template->add_css('system/application/views/common/jquery-ui-1.11.4.custom/jquery-ui.min.css');
		$this->template->add_css('system/application/views/common/bootstrap/css/bootstrap.min.css');
		$this->template->add_css('system/application/views/common/tablesorter/theme.default.css');
		$this->template->add_css('system/application/views/common/spectrum/spectrum.css');
		$this->template->add_css('system/application/views/common/joyride/joyride-2.1.css');
		$this->template->add_css('system/application/views/pegboard.css');
		$this->template->add_js(base_url().'system/application/views/common/jquery-1.11.3.min.js');
		$this->template->add_js(base_url().'system/application/views/common/jquery-ui-1.11.4.custom/jquery-ui.min.js');
		$this->template->add_js(base_url().'system/application/views/common/bootstrap/js/bootstrap.min.js');
		$this->template->add_js(base_url().'system/application/views/common/bootbox.min.js');
		$this->template->add_js(base_url().'system/application/views/common/tablesorter/jquery.tablesorter.min.js');
		$this->template->add_js(base_url().'system/application/views/common/tablesorter/jquery.tablesorter.widgets.js');
		$this->template->add_js(base_url().'system/application/views/common/endless_scroll/endless_scroll.min.js');
		$this->template->add_js(base_url().'system/application/views/common/match-height/jquery.matchHeight.js');
		$this->template->add_js(base_url().'system/application/views/common/spectrum/spectrum.js');
		$this->template->add_js(base_url().'system/application/views/common/joyride/jquery.joyride-2.1.js');
		$this->template->add_js(base_url().'system/application/views/common/jquery.storageapi.js');
		$this->template->add_js(base_url().'system/application/views/common/linkify/linkify.js');
		$this->template->add_js(base_url().'system/application/views/common/FileSaver.min.js');
		$this->template->add_js(base_url().'system/application/views/common/jquery.spreadsheet_model.js');
		$this->template->add_js(base_url().'system/application/views/common/jquery.advanced_search.js');
		$this->template->add_js(base_url().'system/application/views/common/scalar/jquery.add_metadata.js');
		$this->template->add_js(base_url().'system/application/views/pegboard.js');
		$this->template->render("pegboard", $this->data);

	}
	
	public function ontologies() {
	
		$this->data['content'] = $this->config->item('ontologies');
		// Reset keys to 0..N
		foreach ($this->data['content'] as $prefix => $values) {
			$this->data['content'][$prefix] = array_values($values);
		}
		echo json_encode($this->data['content']);
	
	}
	
	public function namespaces() {
		
		$this->data['content'] = $this->config->item('namespaces');
		echo json_encode($this->data['content']);
	
	}

}
?>