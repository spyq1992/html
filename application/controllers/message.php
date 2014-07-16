<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	function __construct() {
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Message_model');
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
		$data['title'] = '我的消息';
		//检查是否有好友申请+站内信
		$count_info=$this->get_msg_count();
		$data['fq_count']=$count_info['fq_count'];
		$data['nfq_count']=$count_info['nfq_count'];
		$data['fq_array']=$this->Message_model->get_friend_request($this->session->userdata['id']);
		$data['nfq_array']=$this->Message_model->get_zhannei_msg($this->session->userdata['id']);
		$this->load->view('message_index',$data);
	}

	public function get_msg_count_ajax()
	{
		$user_id=$_POST['user_id'];
		$msgCount=$this->Message_model->get_msg_count($user_id);

		echo $msgCount['total_count'];
	}

	public function get_msg_count()
	{
		$user_id=$this->session->userdata['id'];
		$msgCount=$this->Message_model->get_msg_count($user_id);

		return $msgCount;
	}

	public function fq_hasread_ajax()
	{
		$user_id=$_POST['user_id'];
		$this->Message_model->set_fq_hasread($user_id);
		echo "success";
	}


}

/* End of file message.php */
/* Location: ./application/controllers/message.php */