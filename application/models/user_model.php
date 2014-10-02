<?php
	class User_model extends CI_Model {
		function __construct() {
			parent::__construct();
		}
		
		//注册用，获取邮箱是否被占用
		function get_email($email)
		{
			$query = $this->db->get_where('user_ginfo', array('email' => $email));
			if(count($query->result())==0)
			{
				return 0;
			}
			else{
				return 1;
			}
		}

		function regist_user($userinfo)
		{
			$user = array(
				'email' => $userinfo['email'],
				'password' => md5($userinfo['password']),
				'real_name' => $userinfo['real_name']
			);
			$this->db->insert('user_ginfo', $user);
			$user_id = $this->db->insert_id();
			$user_einfo = array(
				'id' => $user_id	
			);
			$this->db->insert('user_einfo', $user_einfo);
			return $user_id;
		}

		function login($userinfo) {
			$query = $this->db->get_where('user_ginfo', array('email' => $userinfo['email']));
			$password='';
			foreach ($query->result() as $row)
			{
				$password= $row->password;
			}
			if($password==md5($userinfo['password']))
			{
				return 1;
			}
			else{
				return 0;
			}
		}
		

		function get_user($email)
		{
			$query = $this->db->get_where('user_ginfo', array('email' => $email));
			foreach ($query->result() as $row)
			{
				$userinfo['email']= $row->email;
				$userinfo['real_name']= $row->real_name;
				$userinfo['id']= $row->id;
			}
			$query = $this->db->get_where('user_einfo', array('id' => $userinfo['id']));
			foreach ($query->result() as $row)
			{
				$userinfo['avatar']= $row->avatar;
			}
			return $userinfo;
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
		// function get_user_by_uid($uid){
			// $query = $this->db->get_where('user_sns', array('u_id' => $uid));
			// foreach ($query->result() as $row)
			// {
				// $userinfo['email']= $row->email;
				// $userinfo['real_name']= $row->real_name;
				// $userinfo['id']= $row->id;
			// }
			// return $userinfo;
		// }
		function link_sns_to_user($data){
			$newdata = array(
			                	
			                'u_id'=> $data['u_id'],			                		                
			                'token' =>$data['token0'],
			                'remind' => $data['token1'],
			                'token_ei' => $data['token2'],
			                'token_uid' => $data['token3'],
			                'type' => $data['type'],
			                'linked'=>1
			     );
			$this->db->insert('user_sns', $newdata);
		}
		function add_new_sns_user($data){
			$newdata = array(
			                'uid' => $data['uid'],				            			             		                
			                'token_access_token' => $data['token0'],
			                'token_remind_in' => $data['token1'],
			                'token_expires_in' => $data['token2'],
			                'token_uid' => $data['token3'],
			                'type' => $data['type'],
			                'linked'=>1
			     );
			$this->db->insert('user_sns', $newdata);
		}

		function get_user_einfo($id)
		{
			$query = $this->db->get_where('user_einfo', array('id' => $id));
			foreach ($query->result() as $row)
			{
				$user_einfo['avatar']= $row->avatar;
				$user_einfo['info']= $row->info;
			}
			return $user_einfo;
		}

		//0:getList   1:add   2:edit  3:delete
		function locList_operate($locinfo,$operate_type){
			switch ($operate_type) {
				case 0:
					//get_location_list
					$this->db->select('*');
					$this->db->where('user_id', $locinfo['user_id']); 
					$this->db->where('is_effect', 1); 
					$this->db->where('is_delete', 0); 
					$this->db->order_by("id", "asc");
					$this->db->from('location_info');
					$query = $this->db->get();

					$location_list=array();
					if($query->num_rows() > 0)
					{
						foreach ($query->result() as $row)
						{
							$location_list[$row->id]['id']= $row->id;
							$location_list[$row->id]['city']= $row->city;
							$location_list[$row->id]['location_name']= $row->location_name;
							$location_list[$row->id]['location_point']= $row->location_point;
							$location_list[$row->id]['location_des']= $row->location_des;
							$location_list[$row->id]['times']= $row->times;
						}
					}
					return $location_list;
					break;
				case 1:
					//add_a_location
					$location = array(
						'user_id' => $locinfo['user_id'],
						'city' => $locinfo['city'],
						'location_name' => $locinfo['location_name'],
						'location_point' => $locinfo['location_point'],
						'location_des' => $locinfo['location_des']
					);
					$this->db->insert('location_info', $location);
					return $this->db->insert_id();
					break;

				case 2:
					//edit_location
					$this->db->select('*');
					$this->db->where('id', $locinfo['id']); 
					$this->db->from('location_info');
					$query = $this->db->get();
					$location_list=array();
					if($query->num_rows() > 0)
					{
						foreach ($query->result() as $row)
						{
							$location_list['id']= $row->id;
							$location_list['city']= $row->city;
							$location_list['location_name']= $row->location_name;
							$location_list['location_point']= $row->location_point;
							$location_list['location_des']= $row->location_des;
							$location_list['times']= $row->times;
						}
						return $location_list;
					}
					else{
						return false;
					}
					
					break;

				case 3:
					//delete_location
					$data = array(
					               'is_delete' => 1,
					               'is_effect' => 0
					            );

					$this->db->where('id', $locinfo['id']);
					if($this->db->update('location_info', $data))
					{
						return true;
					}
					else{
						return false;
					}
					break;

				case 4:
					//update_location
					$data = array(
							'city' => $locinfo['city'],
							'location_name' => $locinfo['location_name'],
							'location_point' => $locinfo['location_point'],
							'location_des' => $locinfo['location_des']
					            );

					$this->db->where('id', $locinfo['id']);
					if($this->db->update('location_info', $data))
					{
						return true;
					}
					else{
						return false;
					}
					break;

				
				default:
					# code...
					break;
			}
		}
		

		function add_friend_by_id($uid,$fid)
		{
			$relation = array(
						'uid' => $uid,
						'fid' => $fid
					);

			$this->db->insert('user_relation', $relation);
			$record_id = $this->db->insert_id();
			return $record_id;
		}

		function get_user_list_by_kwd($keyword)
		{
			$this->db->select('id,real_name');
			$this->db->like('real_name', $keyword);
			$query = $this->db->get('user_ginfo');
			foreach ($query->result() as $row)
			{
				$einfo=$this->get_user_einfo($row->id);
				$query = $this->db->get('user_ginfo');
				$list[$row->id]['real_name']=$row->real_name;
				$list[$row->id]['avatar']=$einfo['avatar'];
				$list[$row->id]['info']=$einfo['info'];
			}
			return $list;
			
		}

		function get_relation($uid,$fid)
		{
			//check if uid has focus fid
			$from=$uid;
			$to=$fid;
			if($uid>$fid)
			{
				$t=$uid;
				$uid=$fid;
				$fid=$t;
			}

			$this->db->select('uid,fid');
			$this->db->where('uid', $uid);
			$this->db->where('fid', $fid);
			$this->db->from('user_relation');
			$result_count=$this->db->count_all_results();
			if($result_count==0)
			{
				//check if the user has sent friend request 
				$this->db->select('*');
				$this->db->where('sender_id', $from);
				$this->db->where('receiver_id', $to);
				$this->db->where('is_request', '1');
				$this->db->from('msg_send');
				$request_count=$this->db->count_all_results();
				if($request_count!=0)
				{
					return 'is_sent';
				}
				else{
					return 'nothing';
				}
			}
			else{
				return 'is_friend';
			}	
		}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
		//初始化用户数据
		function _initialize($user_id) {
			// 权限初始化
			$post_access = Access_factory::get_access('post');
			$post_access->init($user_id);
			$comment_auth = Access_factory::get_access('comment');
			$comment_auth->init($user_id, 'personal');
			// 相册初始化
			$this->load->model('Album_model');
			$album = array(
				'owner_id' => $user_id,
				'type' => 'personal',
				'name' => '默认相册',
				'comment' => '默认相册'
			);
			$this->Album_model->insert($album);
		}
		
		function update($where = array(), $row = array()) {
			$this->db->where($where);
			$this->db->update('user', $row);
		}
		
		/**
		 * @param string or int(email address or user_id)
		 * @param array like following:
		 * $join = array(
		 * 		'joined_table1' => array('current_table_field', 'joined_table1_field'),
		 * 		'joined_table2' => array('current_table_field', 'joined_table2_field')
		 * )
		 * 
		 * such as $join = array(
		 * 		'user_type' => array('type_id', 'id')
		 * )
		 */ 


		function get_info($param, $join = array()) {
			$result = '';
			$this->jiadb->_table = 'user';
			$field = 'id';
			if(is_array($param)) {
				if(is_int($param[0])) {
					$field = 'id';
				} elseif(is_string($param[0])) {
					$field = 'email';
				}
			} else {
				if(is_numeric($param)) {
					$field = 'id';
				} elseif(is_string($param)) {
					$field = 'email';
				}
			}
			$user = $this->jiadb->fetchJoin(array($field => $param), $join);
			if($user) {
				$user = $user[0];
			}
			return $user;
		}
		
		/*
		// 获取用户变化值 
		function get_meta($meta_key, $meta_table = '') {
			$this->jiadb->_table = 'user';
			$return = 'user_id';
			$where = array(
				'meta_key' => 'follower',
				'meta_value' => $user_id
			);
			if($meta_table) {
				$where['meta_table'] = $meta_table;
			}
			return $this->jiadb->fetchMeta($return, $where);
		}
		 */
		



		// 获取粉丝
		function get_followers($user_id, $order = array()) {
			$this->jiadb->_table = 'user';
			$return = 'user_id';
			$where = array(
				'meta_key' => 'follower',
				'meta_table' => 'user',
				'meta_value' => $user_id
			);
			return $this->jiadb->fetchMeta($return, $where, $order);
		}
		
		// 获取关注
		/**
		 * @param int 
		 * @param string user or corporation or activity
		 */
		function get_following($user_id, $meta_table = 'user', $order = array()) {
			$this->jiadb->_table = 'user';
			$return = 'meta_value';
			$where = array(
				'meta_key' => 'follower',
				'meta_table' => $meta_table,
				'user_id' => $user_id
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		// 获取关注的社团
		function get_following_co($user_id, $meta_table = 'corporation', $order = array()) {
			$this->jiadb->_table = 'user';
			$return = 'meta_value';
			$where = array(
				'meta_key' => 'follower',
				'meta_table' => $meta_table,
				'user_id' => $user_id
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		function get_join_co($user_id, $meta_table = 'user', $order = array()) {
			$this->jiadb->_table = 'corporation';
			$return = 'corporation_id';
			$where = array(
				'meta_key' => 'member',
				'meta_table' => $meta_table,
				'meta_value' => $user_id
			);
			$corporations =  $this->jiadb->fetchMeta($return, $where);
			$ma_co = $this->jiadb->fetchAll(array('user_id' => $user_id));
			if($ma_co) {
				$corporations[] = $ma_co[0]['id'];
			}
			return $corporations;
		}
		
		function get_blockers($user_id, $order = array()) {
			$this->jiadb->_table = 'user';
			$reutrn = 'meta_value';
			$where = array(
				'meta_key' => 'blocker',
				'meta_table' => 'user',
				'user_id' => $user_id
			);
		}
		
		/**
		 * @param int follower_id
		 * @param int following_id
		 */
		function follow($user_id, $following_id, $unfollow = FALSE) {
			$meta_array = array(
				'user_id' => $user_id,
				'meta_table' => 'user',
				'meta_key' => 'follower',
				'meta_value' => $following_id
			);
			if($unfollow) {
				$this->db->where($meta_array);
				$this->db->delete('user_meta', $meta_array);
				return TRUE;
			} else {
				// 被关注者的黑名单
				$following_blockers = $this->get_blockers($following_id);
				// 关注者的黑名单
				$follower_blockers = $this->get_blockers($user_id);
				// 需要满足 关注者不在被关注者的黑名单内同时 被关注者也不在关注者的黑名单内
				if($following_blockers && (in_array($user_id, $following_blockers) || in_array($following_id, $follower_blockers))) {
					return FALSE;
				} else {
					$this->insert_meta($meta_array);
					return TRUE;
				}
			}
			
		}
		
		/**
		 * @param int master_id
		 * @param int blocker_id
		 */
		function block($user_id, $blocker_id, $unblock = FALSE) {
			$meta_array = array(
				'user_id' => $user_id,
				'meta_key' => 'blocker',
				'meta_table' => 'user',
				'meta_value' => $blocker_id
			);
			if($unblock) {
				$this->db->where($meta_array);
				$this->db->delete('user_meta', $meta_array);
			} else {
				// 移除关注
				$delete_following = array(
					'user_id' => $user_id,
					'meta_key' => 'follower',
					'meta_table' => 'user',
					'meta_value' => $blocker_id
				);
				
				// 移除粉丝
				$delete_follower = array(
					'user_id' => $blocker_id,
					'meta_key' => 'follower',
					'meta_table' => 'user',
					'meta_value' => $user_id
				);
				$this->delete_meta('user_meta', $delete_follower);
				$this->delete_meta('user_meta', $delete_following);
				$this->insert_meta('usermeta', $meta_array);
			}
		}
		
		function insert_meta(array $meta_array) {
			$this->jiadb->_table = 'user_meta';
			if($this->jiadb->fetchAll($meta_array)) {
				return;
			} else {
				$this->db->insert('user_meta', $meta_array);
				return;
			}
		}
		
		function delete_meta(array $meta_array) {
			$this->db->where($meta_array);
			$this->db->delete('user_meta');
		}

}
