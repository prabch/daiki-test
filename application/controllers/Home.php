<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->auth = $this->auth_model->current_auth();
	}

	public function index()
	{
		//checks whether user is authorized, authorized users are redirected to all courses page while guests are redirected to signin page
		if ($this->auth->logged_in) redirect('/courses', 'refresh');
		else redirect('/signin', 'refresh');
	}

	public function signin()
	{
		$data['title'] = 'Sign In';

		//if user is logged in and request contains logout query param, we call the logout method
		if ($this->auth->logged_in && $this->input->get('logout')) {
			$this->auth_model->logout_user();
		} elseif 
			($this->auth->logged_in || (
				$this->input->method() == 'post' && 
				$this->auth_model->login_user($this->input->post('username'), $this->input->post('password'))
			)) 
		{
			/*in above condition we check whether the request is using POST method, if so we submit data to the login method
			user will be redirected to all courses page on a successful login, if not back to the sign in page */
			redirect('/courses', 'refresh');
		}

		$this->load->view('templates/header', $data);
		$this->load->view('home/signin', $data);
		$this->load->view('templates/footer');
	}

	public function signup(){
		//if the request is using POST methods, we submit data to the model
		if ($this->input->method() == 'post' && $this->auth_model->create_user($this->input->post())) {
			 redirect('/signin', 'refresh');
		}

		$data['title'] = 'Sign Up';
		$this->load->view('templates/header', $data);
		$this->load->view('home/signup');
		$this->load->view('templates/footer');
	}
}
