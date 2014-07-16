<?php
	class Message_model extends CI_Model {
		function __construct() {
			parent::__construct();

		}
		
	//error code
	//1:all suc       0:fail in 'msg_send'   2:fail in 'msg_info'
	function send_friend_request($from,$to,$text="")
	{
		$from_info=$this->get_user_by_id($from);
		$message_info = array(
						'msg_title' => '用户【'.$from_info['real_name'].'】请求加您为好友',
						'msg_content' => $text,
						'msg_senderid'=>$from
					);

		$this->db->insert('msg_info', $message_info);
		$mi_record = $this->db->insert_id();
		//insert to msg_send after insert msg_info succesfully
		//or return error code
		if(is_numeric($mi_record)){

			$sender_info = array(
						'sender_id' => $from,
						'receiver_id' => $to,
						'text_id'=>$mi_record,
						'is_request'=>1
					);

			$this->db->insert('msg_send', $sender_info);
			$ms_record = $this->db->insert_id();

			$data = array(
               'record_id' => $ms_record
            );

			$this->db->where('id', $mi_record);
			$this->db->update('msg_info', $data); 

			if($ms_record)
			{
				return 1;
			}
			else{
				return 0;
			}
		}
		else{
			return 2;
		}

	}


	function get_user_by_id($id)
	{
		$query = $this->db->get_where('user_ginfo', array('id' => $id));
		foreach ($query->result() as $row)
		{
			$userinfo['email']= $row->email;
			$userinfo['real_name']= $row->real_name;
			$userinfo['id']= $row->id;
		}
		return $userinfo;
	}


	function get_msg_count($uid)
	{
		$this->db->select('*');
		$this->db->where('receiver_id', $uid);
		$this->db->where('is_request', '1');
		$this->db->where('is_read', '0');
		$this->db->from('msg_send');
		$f_count=$this->db->count_all_results();

		$this->db->select('*');
		$this->db->where('receiver_id', $uid);
		$this->db->where('is_request', '0');
		$this->db->where('is_read', '0');
		$this->db->from('msg_send');
		$nf_count=$this->db->count_all_results();

		$total=$nf_count+$f_count;

		$count_info=array('fq_count'=>$f_count,"nfq_count"=>$nf_count,"total_count"=>$total);

		return $count_info;
	}


	//get an arran which contain all friend_request
	public function get_friend_request($uid)
	{
		//select * from `msg_info` where `id`=(select `text_id` from `msg_send` where `receiver_id`=2 and `is_request`=1 and `is_read`=0)

		$where="id=(select `text_id` from `msg_send` where `receiver_id`=".$uid." and `is_request`=1 and `is_deal`=0)";
		$this->db->select('record_id,msg_title,msg_content,msg_senderid,createtime');
		$this->db->where($where);
		$this->db->from('msg_info');
		$query = $this->db->get();

		$friend_request=array();
		$count=0;
		foreach ($query->result() as $row)
		{
			$friend_request[$count]['record_id']= $row->record_id;
			$friend_request[$count]['msg_title']= $row->msg_title;
			$friend_request[$count]['msg_content']= $row->msg_content;
			$friend_request[$count]['msg_senderid']= $row->msg_senderid;
			$friend_request[$count]['createtime']= $row->createtime;

			$this->db->select('real_name');
			$this->db->where('id',$friend_request[$count]['msg_senderid']);
			$this->db->from('user_ginfo');
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				$friend_request[$count]['real_name']= $row->real_name;
			}

			$this->db->select('avatar');
			$this->db->where('id',$friend_request[$count]['msg_senderid']);
			$this->db->from('user_einfo');
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				$friend_request[$count]['avatar']= $row->avatar;
			}

			$count++;
		}

		return $friend_request;

	}

	//set the friend request "is_read"=1
	public function set_fq_hasread($uid)
	{
		$data = array(
               'is_read' => 1
            );

		$this->db->where('receiver_id', $uid);
		$this->db->update('msg_send', $data); 
	}


	public function be_friend($rid)
	{
		$data = array(
               'is_deal' => 1
            );

		$this->db->where('id', $rid);
		$this->db->update('msg_send', $data);
	}

	//send the two users msg to tell them they are friends now
	//sender_id: 0 means this msg is sent from official team
	public function send_befriend_msg($uid, $fid)
	{
		$fid_info=$this->get_user_by_id($fid);
		$uid_info=$this->get_user_by_id($uid);
		$message_info = array(
						'msg_title' => '用户【'.$fid_info['real_name'].'】已经和您成为好友',
						'msg_content' => '恭喜您！您又多了以为好友，可以邀请Ta参加聚会，或者查看他的动态',
						'msg_senderid'=>0
					);

		$this->db->insert('msg_info', $message_info);
		$mi_record = $this->db->insert_id();
		//insert to msg_send after insert msg_info succesfully
		//or return error code
		if(is_numeric($mi_record)){

			$sender_info = array(
						'sender_id' => 0,
						'receiver_id' => $uid,
						'text_id'=>$mi_record,
						'is_request'=>0
					);

			$this->db->insert('msg_send', $sender_info);
			$ms_record = $this->db->insert_id();

			$data = array(
               'record_id' => $ms_record
            );

			$this->db->where('id', $mi_record);
			$this->db->update('msg_info', $data); 

		}
	}


	//get an arran which contain all zhannei_msg
	public function get_zhannei_msg($uid)
	{
		//select * from `msg_info` where `id`=(select `text_id` from `msg_send` where `receiver_id`=2 and `is_request`=1 and `is_read`=0)

		$where="id=(select `text_id` from `msg_send` where `receiver_id`=".$uid." and `is_request`=0)";
		$this->db->select('record_id,msg_title,msg_content,msg_senderid,createtime');
		$this->db->where($where);
		$this->db->from('msg_info');
		$query = $this->db->get();

		$zhannei_msg=array();
		$count=0;
		foreach ($query->result() as $row)
		{
			$zhannei_msg[$count]['record_id']= $row->record_id;
			$zhannei_msg[$count]['msg_title']= $row->msg_title;
			$zhannei_msg[$count]['msg_content']= $row->msg_content;
			$zhannei_msg[$count]['msg_senderid']= $row->msg_senderid;
			$zhannei_msg[$count]['createtime']= $row->createtime;

			if($zhannei_msg[$count]['msg_senderid']!=0)
			{
				$this->db->select('real_name');
				$this->db->where('id',$zhannei_msg[$count]['msg_senderid']);
				$this->db->from('user_ginfo');
				$query = $this->db->get();
				foreach ($query->result() as $row)
				{
					$zhannei_msg[$count]['real_name']= $row->real_name;
				}

				$this->db->select('avatar');
				$this->db->where('id',$zhannei_msg[$count]['msg_senderid']);
				$this->db->from('user_einfo');
				$query = $this->db->get();
				foreach ($query->result() as $row)
				{
					$zhannei_msg[$count]['avatar']= $row->avatar;
				}
			}
			else{
					$zhannei_msg[$count]['real_name']="聚会神器团队";
					$zhannei_msg[$count]['avatar']= "official.jpg";

			}

			$count++;
		}

		return $zhannei_msg;

	}
	



}
