<?php
class modeladmin extends CI_Model 
{
	var $name = '';
	var $id = '';
	var $password = '';
	
	function __construct()
	{
		parent::__construct();
	}

	function getLoginType(){

		$this->db->select('id,user_type, username, email');
        $this->db->from('login');
        $selectLoginTypeQuery = $this->db->get();
        return $selectLoginTypeQuery->result();
    }
	
	function authenticateUser()
    {

        $login_type = $this->input->post('login_type');
        $password = md5($this->input->post('password'));

        $this->db->select('id,user_type, username, email,profile_image');
        $this->db->from('login');
        $this->db->where('username', $login_type);
        $this->db->where('password', $password);
        $query = $this->db->get();

	    $rs = $query->result_array();
		 

		if(count($rs) > 0)
		{
			$machine_ip = $_SERVER['REMOTE_ADDR'];

			$data = array(
			        'last_login_ip' => $machine_ip,
			        'last_login' => date('Y-m-d H:i:s')
			);

			$this->db->where('id', $rs[0]['id']);
			$this->db->update('login', $data);

			$this->session->set_userdata('user_id', $rs[0]['id']);
			$this->session->set_userdata('username', $rs[0]['username']);
			$this->session->set_userdata('user_type',$rs[0]['user_type']);
			$this->session->set_userdata('profile_image',$rs[0]['profile_image']);
			return true;
		}else{
			
		   return false;
		}	
		
   	}

		
	function updatePassword($email)
	{
		$password	= $this->input->post('new_password');
		
		$sql = "update users set password = '".md5($password)."' where email = '".$email."' ";
		$query = $this->db->query($sql);
		return true;
	}
	

	function valideOldPassword($email)
	{	
		$old_password 	= 	md5($this->input->post('old_password'));
	
		$sql = "SELECT count(*) as CNT FROM users WHERE email ='".$email."' and password = '".$old_password."' ";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
				
		if(count($rs) > 0)
		{
			if($rs[0]['CNT'] > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	/*
	function valideNewPassword
	This function to check the New Password and Confirm New Password will be same or not
	if both are the same then return true else return false
	*/
	function valideNewPassword() 
	{
		$new_admin_pwd 		= 	$this->input->post('new_admin_pwd');
		$conf_new_admin_pwd 	= 	$this->input->post('conf_new_admin_pwd');
		
		if($new_admin_pwd != '' && $conf_new_admin_pwd != '')
		{
			if($new_admin_pwd === $conf_new_admin_pwd)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function logout()
	{

	   $this->db->set('last_logout', date('Y-m-d H:i:s'));
       $this->db->where('id', $this->session->userdata('user_id'));
       $query = $this->db->update('login');
		
	   if($query){
	   	return true;
	   }else{
	   	 return false;
	   }
	}

	
}
?>