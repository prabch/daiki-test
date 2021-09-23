<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecturers extends CI_Controller {

	private $auth;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->auth_model->current_auth();
		//checks whether user is authorized, if not redirects to the sign in page
		if (!$this->auth->logged_in) redirect('/signin', 'refresh');

		//checks whether the user is an admin, if not shows an error
		if ($this->auth->user_level != 'admin') {
			 $this->load->view('templates/error', ['error' => 'unauthorized access']); 
			 return FALSE;
		}
		$this->load->model('lecturer_model');
	}

	//shows all lecturers
	public function index()
	{
		$data['title'] = 'Lecturers';
		$data['lecturers'] = $this->lecturer_model->get_lecturers();
		$this->load->view('templates/header', $data);
		$this->load->view('lecturers/all', $data);
		$this->load->view('templates/footer');
	}

	public function edit($lecturer_id = FALSE)
	{
		//checking whether a valid user id is provided (stage 1)
		if ($lecturer_id && is_numeric($lecturer_id)) {

			//if the request is using POST methods, we submit data to the model
			if ($this->input->method() == 'post') {
				$this->lecturer_model->edit_lecturer($lecturer_id, $this->input->post('status'));
			}

			//checking whether a valid user id is provided (stage 2)
			if ($lecturer = $this->lecturer_model->get_lecturerbyid($lecturer_id)) {
				$data['title'] = 'Edit lecturer ' . $lecturer_id;
				$data['lecturer'] = $lecturer;
				$this->load->view('templates/header', $data);
				$this->load->view('lecturers/edit', $data);
				$this->load->view('templates/footer');
				return TRUE;
			}
		}

		//showing an error page if an invalid user id is provided
		$this->load->view('templates/error', ['error' => 'invalid lecturer id']); 
	}

}
