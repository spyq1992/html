<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct() {
			parent::__construct();
			$this->load->library('Authcode');
			$this->load->model('User_model');
			$this->load->library('saetoauthv');
			
	}

	public function index()
	{
		$data['title'] = '欢迎';
		$data['css'] = array('welcome.css');
		$this->load->view('welcome',$data);
	}

	public function register()
	{
		if($_POST!=null){
			$code=$_POST['code'];
			$apiUrl1="https://api.weibo.com/oauth2/access_token?client_id=392060278&client_secret=58affb1572f7799811865bb6413148b4&grant_type=authorization_code&code=".$code."&redirect_uri=partyus.wicp.net/index/register";
			$ch1 = curl_init();
			curl_setopt($ch1, CURLOPT_URL, $apiUrl);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch1, CURLOPT_ENCODING, 'UTF-8');
			$token = curl_exec($ch1);
			var_dump($token);
			
		}
		else{
			$data['title'] = '注册';
			//$data['css'] = array('welcome.css');
			$data['js'] = array('regist_view.js');


			//微博相关信息生成
			$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
			$state = uniqid( 'weibo_', true);
			$session = array(
					'weibo_state' => $state
			);
			$this->session->set_userdata($session);
			$data['code_url'] = $o->getAuthorizeURL( WB_CALLBACK_URL , 'code', $state );

			$this->load->view('register_index',$data);
		}
	}

	public function show_captcha(){    
		//此方法用于显示验证码图片，归一个view中的img的src调用
		//var_dump("123");exit;
        $this->authcode->show(); 
    }

    public function do_regist()
    {
    	$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('pwd');
		$data['real_name'] = $this->input->post('name');
		if($this->User_model->regist_user($data))
		{
			$mdata['message']="欢迎加入聚会神器！";
			$mdata['title']="注册成功";
			$mdata['message_type']="success";
			$mdata['jump_url']=site_url();
		}
		else{
			$mdata['message']="抱歉，由于系统问题造成注册失败！请联系相关人员。";
			$mdata['title']="注册失败";
			$mdata['message_type']="error";
			$mdata['jump_url']=site_url();
		}
		$this->load->view('message',$mdata);
    }

    public function validate_authcode()
    {
		$captcha_value=$_POST['captcha_in'];
		$authcode_value=$this->session->userdata('auth_code');
		//比较用户输入和session中存放的验证码
		if(strcasecmp($captcha_value,$authcode_value)==0)
		{
			echo "suc";
		}
		else{
			echo "fail";
		}
    }

    public function validate_email()
    {
		$email_value=$_POST['email_in'];
		//从数据库中查寻，获取条数
		$result=$this->User_model->get_email($email_value);
		if($result==1)
		{
			echo '1';
		}
		else{
			echo '0';
		}
    }

    public function login()
    {
    	$data['title'] = '登录';
		$data['js'] = array('login_view.js');
		$this->load->view('login_index',$data);
    }

    public function do_login()
    {
    	$data['email']=$_POST['email_in'];
    	$data['password']=$_POST['password_in'];
    	if($this->User_model->login($data))
		{
			//成功设置session
			$result=$this->User_model->get_user($data['email']);
			$session = array(
				'id' => $result['id'],
				'email' => $result['email'],
				'real_name' => $result['real_name'],
				'avatar' => $result['avatar']
			);
			$this->session->set_userdata($session);
			echo "suc";
		}
		else{
			$email_validate=$this->User_model->get_email($data['email']);
			if($email_validate==0)
			{
				echo 'emptyemail';
			}
			else{
				echo 'wrongpwd';
			}
		}
    }

    public function logout() {
			$this->session->sess_destroy();
			redirect('index/');
	}

	public function sina_callback()
	{
		 	
		$o = new saetoauthv( WB_AKEY , WB_SKEY );


		

							
			if (isset($_REQUEST['code'])) {
				$keys = array();
				$keys['code'] = $_REQUEST['code'];
				$keys['redirect_uri'] = WB_CALLBACK_URL;
				$keys['refresh_token']= null;
				try {
					$token = $o->getAccessToken( 'code', $keys ) ; ;
					$_SESSION['token'] = $token;
					setcookie( 'weibojs_'.$this->saetoauthv->client_id, http_build_query($token) );	
					$this->load->view('sinacallback');
				} catch (OAuthException $e) {
				}
			}
			
	}
	public function loginWithWeibo(){
		
		    
			$code_url = $this->saetoauthv->getauthorizeurl( WB_CALLBACK_URL );
			redirect($code_url);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */