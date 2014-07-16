<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct() {
			parent::__construct();
			$this->load->model('User_model');
	}

	/**
	 * @param $sign 当为TRUE时需要登录，当为FALSE是需要不登陆
	 */
	function _require_login($sign = TRUE) {
		if($sign && $this->session->userdata('id') == NULL) {
			if(!$this->input->get('jump')) {
				$jump = substr(uri_string(), 0);
				redirect('index/login?jump=' . $jump);
			} else {
				redirect('index/login');
			}
		} elseif(!$sign && $this->session->userdata('id') !=NULL ) {
			redirect();
		}
	}

	public function index()
	{
		$this->_require_login(TRUE);
		$keyword=$this->input->post('keyword');
		$data['user_list']=$this->User_model->get_user_list_by_kwd($keyword);
		if(count($data['user_list'])==0)
		{
			$mdata['message']="抱歉，没有您想搜索的用户！请再次尝试...";
			$mdata['title']="搜索失败";
			$mdata['message_type']="error";
			$mdata['jump_url']=site_url('/index');
			$this->load->view('message',$mdata);
		}
		else{
			//var_dump($res_list);
			$data['title'] = '搜索用户';
			$this->load->view('search_list',$data);
		}
	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */