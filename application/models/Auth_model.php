<?php
class Auth_model extends CI_Model {

	//Returns auth session data as an easy accessible object
	public function current_auth()
	{	
		$data = ['logged_in' => FALSE];

		if ($user_id = $this->session->user_id) $data['user_id'] = $user_id;
		else $data['user_id'] = FALSE; 

		if ($name = $this->session->name) $data['name'] = $name;
		else $data['name'] = FALSE;

		if ($user_level = $this->session->user_level) $data['user_level'] = $user_level;
		else $data['user_level'] = FALSE;

		if($data['user_id'] && $data['name'] && $data['user_level']) $data['logged_in'] = TRUE;

		return (object)$data;
	}

	public function login_user(string $username = NULL, string $password = NULL)
	{
		if ($username && $password) {
			$query = $this->db->get_where('users', ['username' => $username]);
			if ($row = $query->row()) {
				if ($row->status != 'active') {
					$this->session->set_flashdata('error', 'inactive user account');
					return FALSE;
				} elseif(password_verify($password, $row->password)) {
					$this->session->set_userdata(['user_id' => $row->user_id, 'name' => $row->name, 'user_level' => $row->user_level]);
					return TRUE;
				}
			}
		}
		$this->session->set_flashdata('error', 'invalid username or password');
		return FALSE;
	}

	public function logout_user()
	{
		$this->session->unset_userdata(['user_id', 'name', 'user_level']);
		$this->session->set_flashdata('message', 'you have been logged out !');
	}

	public function create_user(array $user_data = [], string $user_level = 'lecturer', string $status = 'active')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_data($user_data);
		$this->form_validation->set_rules('name', 'name', 'trim|required');
    	$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]');
    	$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
    	$this->form_validation->set_rules('password_verify', 'password verification', 'trim|required|matches[password]');
    	$this->form_validation->set_message('is_unique', 'This {field} is already taken.');
        if ($this->form_validation->run() === true){
        	$this->db->insert('users', ['name' => $user_data['name'], 'username' => $user_data['username'], 'password' => password_hash($user_data['password'], PASSWORD_DEFAULT), 'user_level' => $user_level, 'status' => $status]);
        	$this->session->set_flashdata('message', 'your account has been created');
        	return TRUE;
        } else {
        	$this->session->set_flashdata('error', 'please recheck your details');
        }
        return FALSE;
	}

}