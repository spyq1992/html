<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {

	function __construct() {
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Photo_model');
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

	}

	public function setting()
	{
		$this->_require_login(TRUE);
		$data['title'] = '个人设置';
		$data['js']='setting_view.js';
		$data['user_einfo']=$this->User_model->get_user_einfo($this->session->userdata('id'));
		$data['location_list']=$this->User_model->locList_operate(array('user_id'=>$this->session->userdata('id')),0);
		$data['is_edit']=0;
		$this->load->view('setting',$data);
	}

	public function setting_avatar()
	{	
		$filename = $this->session->userdata('id') . '.jpg';
		$path=getcwd().'/data/avatar/personal/';
		$config = array(
			  		'allowed_types' => 'jpeg|jpg|png|gif|bmp',
			  		'upload_path' => $path,
			  		'max_size' => 20480,
			  		'max_width' => 100000,
			  		'max_height' => 100000,
			  		'overwrite' => TRUE,
			  		'file_name'	=> $filename
		);
		$res=$this->Photo_model->upload_avatar($config);
		if($res)
		{
			$data['title'] = '个人设置';
			$data['user_einfo']=$this->User_model->get_user_einfo($this->session->userdata('id'));
			$this->load->view('setting',$data);
		}	
	}

	//modify personal instruction 
	public function setting_info()
	{	
		$data = array(
	               'info' => $this->input->post('userinfo')
	            );

		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('user_einfo', $data);	
		$data['title'] = '个人设置';
		$data['user_einfo']=$this->User_model->get_user_einfo($this->session->userdata('id'));
		$this->load->view('setting',$data);

	}

	public function add_location()
	{
		$data['city'] = $this->input->post('selected_city');
		$data['location_name'] = $this->input->post('locname');
		$data['location_point'] = $this->input->post('locpoint');
		$data['location_des'] = $this->input->post('locdes');
		if($this->input->post('locdes')=='')
			$data['location_des'] = '未添加描述';
		$data['user_id']=$this->session->userdata('id');
		if($this->User_model->locList_operate($data,1))
		{
			$mdata['message']="添加据点成功！";
			$mdata['title']="添加成功";
			$mdata['message_type']="success";
			$mdata['jump_url']=site_url('personal/setting');
		}
		else{
			$mdata['message']="抱歉，由于系统问题造成据点添加失败！请联系相关人员。";
			$mdata['title']="添加失败";
			$mdata['message_type']="error";
			$mdata['jump_url']=site_url('personal/setting');
		}
		$this->load->view('message',$mdata);
	}

	public function location_operate()
	{
		//modify: get the data by id, then redirect to setting page after modify
		//delete: delete from db directly
		$data['id']=$this->input->post('location_id');
		$type=$this->input->post('operate_type');
		if($type=='edit')
		{
			if($this->User_model->locList_operate($data,2))
			{

				$data['title'] = '个人设置';
				$data['js']='setting_view.js';
				$data['user_einfo']=$this->User_model->get_user_einfo($this->session->userdata('id'));
				$data['location_list']=$this->User_model->locList_operate(array('user_id'=>$this->session->userdata('id')),0);

				$data['edit_location_info']=$this->User_model->locList_operate($data,2);
				$data['is_edit']=1;
				$this->load->view('setting',$data);
			}
			else{
				$mdata['message']="抱歉，由于系统问题暂时无法编辑！请联系相关人员。";
				$mdata['title']="无法编辑";
				$mdata['message_type']="error";
				$mdata['jump_url']=site_url('personal/setting');
				$this->load->view('message',$mdata);
			}
		}
		else if($type=='delete'){
			if($this->User_model->locList_operate($data,3))
			{
				redirect('personal/setting');
			}
			else{
				$mdata['message']="抱歉，由于系统问题造成据点删除失败！请联系相关人员。";
				$mdata['title']="删除失败";
				$mdata['message_type']="error";
				$mdata['jump_url']=site_url('personal/setting');
				$this->load->view('message',$mdata);
			}
		}
	}


	public function do_edit_location()
	{
		$data['city'] = $this->input->post('selected_city');
		$data['location_name'] = $this->input->post('locname');
		$data['location_point'] = $this->input->post('locpoint');
		$data['location_des'] = $this->input->post('locdes');
		$data['id'] = $this->input->post('location_id');
		if($this->User_model->locList_operate($data,4))
		{
			$mdata['message']="已成功更新据点信息";
			$mdata['title']="编辑成功";
			$mdata['message_type']="success";
			$mdata['jump_url']=site_url('personal/setting');
		}
		else{
			$mdata['message']="抱歉，由于系统问题暂时无法更新据点信息！请联系相关人员。";
			$mdata['title']="编辑失败";
			$mdata['message_type']="error";
			$mdata['jump_url']=site_url('personal/setting');
		}

			$this->load->view('message',$mdata);

	}

	//add friend, send a message 
	public function add_friend()
	{
		//$uid<$fid
		//1.add or warning "already friends"
		//2.send message (call message part)
		$following_id=$this->input->post('uid2');
		if($this->session->userdata('id')<$this->input->post('uid2'))
		{
			$uid=$this->session->userdata('id');
			$fid=$this->input->post('uid2');
		}
		else{
			$fid=$this->session->userdata('id');
			$uid=$this->input->post('uid2');
		}

		$from=$this->session->userdata('id');
		$to=$this->input->post('uid2');
		$text=$this->input->post('vali_text');

		if($this->Message_model->send_friend_request($from,$to,$text)==1)
		{
			$mdata['message']="成功发送好友请求！";
			$mdata['title']="请求成功";
			$mdata['message_type']="success";
			$mdata['jump_url']=site_url('personal/profile/'.$following_id);
		}
		else{
			$mdata['message']="抱歉，由于系统问题暂时无法发送好友请求！请联系相关人员。";
			$mdata['title']="请求失败";
			$mdata['message_type']="error";
			$mdata['jump_url']=site_url('personal/profile/'.$following_id);
		}

		$this->load->view('message',$mdata);
	}

	public function do_add_friend()
	{
		$record_id=$this->input->post('record_id');
		$sender_id=$this->input->post('sender_id');
		$user_id=$this->session->userdata('id');
		//1.modify the record in table "msg_send"
		$this->Message_model->be_friend($record_id);

		//2.add relation
		$this->User_model->add_friend_by_id($user_id,$sender_id);

		//3.send a message to the two users
		$this->Message_model->send_befriend_msg($user_id,$sender_id);
		$this->Message_model->send_befriend_msg($sender_id,$user_id);

		redirect('message/index#panel-530089');
	}

	//delete a friend
	public function del_friend()
	{
		
	}



	//query user by kwd, then show his profile page
	public function profile($id)
	{
		$this->_require_login(TRUE);
		//判断两人关系
		$res=$this->User_model->get_relation($this->session->userdata('id'),$id);
		$data['relation']=$res;
		$data['user_einfo']=$this->User_model->get_user_einfo($id);
		$data['user_ginfo']=$this->User_model->get_user_by_id($id);
		$data['title'] = '个人主页';
		$this->load->view('profile',$data);
	}
}
/* End of file personal.php */
/* Location: ./application/controllers/welcome.php */