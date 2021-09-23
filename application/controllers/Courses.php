<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	private $auth;

	//checks whether user is authorized, if not redirects to the sign in page
	public function __construct(){
		parent::__construct();
		$this->auth = $this->auth_model->current_auth();
		if (!$this->auth->logged_in) redirect('/signin', 'refresh');
		$this->load->model('course_model');
	}

	//shows all courses, can be filtered by user id with a query param
	public function index()
	{
		$data['title'] = 'Courses';
		$data['user_level'] = $this->auth->user_level;
		if ($lecturer_id = $this->input->get('lecturer_id')) $lecturer_id = $lecturer_id;
		else $lecturer_id = FALSE;
		$data['lecturer_id'] = $lecturer_id;
		$data['courses'] = $this->course_model->get_courses($lecturer_id);
		$this->load->view('templates/header', $data);
		$this->load->view('courses/all', $data);
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$data['title'] = 'Add course';
		//shows an error if the user is not a lecturer (admins cannot add courses)
		if ($this->auth->user_level != 'lecturer') {
			 $this->load->view('templates/error', ['error' => 'unauthorized access']); 
			 return FALSE;
		}

		//if the request is using POST methods, we submit data to the model
		if ($this->input->method() == 'post' && $this->course_model->add_course($this->input->post())) {
			redirect('/courses', 'refresh');
		}

		$this->load->view('templates/header', $data);
		$this->load->view('courses/add');
		$this->load->view('templates/footer');
	}

	public function edit($course_id = FALSE)
	{
		//checking whether a valid course id is provided (stage 1)
		if ($course_id && is_numeric($course_id)) {

			//if the request is using POST methods, we submit data to the model
			if ($this->input->method() == 'post') {
				if ($this->auth->user_level == 'admin') $this->course_model->change_course_status($course_id, $this->input->post('status'));
				else $this->course_model->edit_course($course_id, $this->input->post());
			}

			//checking whether a valid course id is provided (stage 2)
			if ($course = $this->course_model->get_coursebyid($course_id)) {
				$data['title'] = 'Edit course ' . $course_id;
				$data['course'] = $course;
				$data['user_level'] = $this->auth->user_level;
				$this->load->view('templates/header', $data);
				$this->load->view('courses/edit', $data);
				$this->load->view('templates/footer');
				return TRUE;
			}
		}
		//showing an error page if an invalid course id is provided
		$this->load->view('templates/error', ['error' => 'invalid course id']); 
	}

	public function delete($course_id = FALSE)
	{
		//shows an error if the user is not a lecturer (admins cannot delete courses)
		if ($this->auth->user_level != 'lecturer') {
			 $this->load->view('templates/error', ['error' => 'unauthorized access']); 
			 return FALSE;
		}

		//checking whether a valid course id is provided (stage 1)
		if ($course_id && is_numeric($course_id)) {

			//if the request is using POST methods, we submit delete request to the model
			if ($this->input->method() == 'post') {
				$this->course_model->delete_course($course_id);
				//redirect back to all courses page after deleting
				redirect('/courses', 'refresh'); 
			}

			//checking whether a valid course id is provided (stage 2)
			if ($course = $this->course_model->get_coursebyid($course_id)) {
				$data['title'] = 'Delete course ' . $course_id;
				$data['course'] = $course;
				$this->load->view('templates/header', $data);
				$this->load->view('courses/delete', $data);
				$this->load->view('templates/footer');
				return TRUE;
			}
		}
		//showing an error page if an invalid course id is provided
		$this->load->view('templates/error', ['error' => 'invalid course id']); 
	}

	public function view($course_id = FALSE)
	{
		//checking whether a valid course id is provided (stage 1)
		if ($course_id && is_numeric($course_id)) {
			//checking whether a valid course id is provided (stage 2)
			 if ($course = $this->course_model->get_coursebyid($course_id)) {
				$data['title'] = 'Course ' . $course_id;
				$data['course'] = $course;
				$data['user_level'] = $this->auth->user_level;
				$this->load->view('templates/header', $data);
				$this->load->view('courses/view', $data);
				$this->load->view('templates/footer');
				return TRUE;
			 }
		}
		//showing an error page if an invalid course id is provided
		$this->load->view('templates/error', ['error' => 'invalid course id']); 
	}
}
