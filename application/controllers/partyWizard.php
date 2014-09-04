<?php
class PartyWizard extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->view('inc/header_view');
		$this->load->view('inc/nav_view');
		$this->load->view('inc/footer_view');
		
	}

	public function index($step = 1) {
		switch ($step) {
			case '1' :
				if (TRUE) {
					$this -> load -> view('PartyWizard/wizardStep1');
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