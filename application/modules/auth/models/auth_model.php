<?php

class Auth_model extends CI_Model 
{
	/*
	*	Validate a personnel's login request
	*
	*/
	public function validate_personnel()
	{
		//select the personnel by username from the database
		$this->db->select('*');
		$this->db->where(array('email' => $this->input->post('personnel_username'), 'activated' => 1, 'password' => md5($this->input->post('personnel_password'))));
		$query = $this->db->get('users');
		
		//if personnel exists
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			//create personnel's login session
			$newdata = array(
                   'login_status'     => TRUE,
                   'first_name'     => $result[0]->first_name,
                   'email'     => $result[0]->email,
                   'personnel_id'  => $result[0]->user_id
               );

			$this->session->set_userdata($newdata);
			
			//update personnel's last login date time
			$this->update_personnel_login($result[0]->user_id);
			return TRUE;
		}
		
		//if personnel doesn't exist
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Update personnel's last login date
	*
	*/
	private function update_personnel_login($personnel_id)
	{
		$data['last_login'] = date('Y-m-d H:i:s');
		$this->db->where('user_id', $personnel_id);
		$this->db->update('users', $data); 
	}
	
	/*
	*	Reset a personnel's password
	*
	*/
	public function reset_password($personnel_id)
	{
		$new_password = substr(md5(date('Y-m-d H:i:s')), 0, 6);
		
		$data['personnel_password'] = md5($new_password);
		$this->db->where('personnel_id', $personnel_id);
		$this->db->update('personnel', $data); 
		
		return $new_password;
	}
	
	/*
	*	Check if a has logged in
	*
	*/
	public function check_login()
	{
		if($this->session->userdata('login_status'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
}
?>