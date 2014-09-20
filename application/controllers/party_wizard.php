<?php
class Party_wizard extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->view('inc/header_view');
		$this->load->view('inc/nav_view');
		$this->load->library('calendar');
	}
	
	public function index($step = 1) {
		switch ($step) {
			case '1' :
				if (TRUE) {
					$test=$this->calendar->getFirstday();
					var_dump($test);
					$this -> load -> view('Party_wizard/wizardStep1');
				}
				break;
			case '2':
				
				break;

			default :
				break;
		}
		

	}

}
?>