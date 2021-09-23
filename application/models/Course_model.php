<?php
class Course_model extends CI_Model {

	private $auth;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->auth_model->current_auth();
	}

	public function get_courses($lecturer_id = FALSE)
	{
		//users table is joined to fetch the lecturer name
		$this->db->order_by('course_id', 'DESC')->select('courses.*, users.name')->from('courses')->join('users', 'users.user_id = courses.user_id');

		if ($this->auth->user_level != 'admin') {
			//If user is not an admin, only their own courses will be fetched
			$this->db->where('users.user_id', $this->auth->user_id);
		} elseif ($lecturer_id && is_numeric($lecturer_id)) {
			//If user is an admin, a filtet can be applied for user_id column
			$this->db->where('courses.user_id', $lecturer_id);
		}

		$query = $this->db->get();
		return $query->result();
	}

	public function get_coursebyid(int $course_id)
	{
		//users table is joined to fetch the lecturer name
		$query = $this->db->select('courses.*, users.name')->from('courses')->where('course_id', $course_id)->join('users', 'users.user_id = courses.user_id')->get();
		return $query->row();
	}

	public function add_course(array $course_data = [])
	{
		$this->load->library('form_validation');
		$this->form_validation->set_data($course_data);
		$this->form_validation->set_rules('course_name', 'course name', 'trim|required');
    	$this->form_validation->set_rules('course_description', 'course description', 'trim|required');
        if ($this->form_validation->run() === true){
        	$this->db->insert('courses', ['course_name' => $course_data['course_name'], 'course_description' => $course_data['course_description'], 'user_id' => $this->auth->user_id, 'status' => 'active']);
        	$this->session->set_flashdata('message', 'course has been created');
        	return TRUE;
        } else {
        	$this->session->set_flashdata('error', 'please recheck the details');
        }
        return FALSE;
	}

	public function edit_course(int $course_id, array $course_data = [])
	{
		if ($course = $this->get_coursebyid($course_id)) {
			if ($course->user_id == $this->auth->user_id){
				$this->load->library('form_validation');
				$this->form_validation->set_data($course_data);
				$this->form_validation->set_rules('course_name', 'course name', 'trim|required');
		    	$this->form_validation->set_rules('course_description', 'course description', 'trim|required');
		        if ($this->form_validation->run() === true || $this->auth->user_level == 'admin'){
		        	$data = ['course_name' => $course_data['course_name'], 'course_description' => $course_data['course_description']];
		        	$this->db->update('courses', $data, ['course_id' => $course_id]);
		        	$this->session->set_flashdata('message', 'course has been edited');
		        	return TRUE;
		        } else {
		        	$this->session->set_flashdata('error', 'please recheck the changes');
		        }
			} else {
				$this->session->set_flashdata('error', 'you are not authorized to edit this course');
			}
		} else {
			$this->session->set_flashdata('error', 'invalid course id');
		}
        return FALSE;
	}

	//Separate function to change course status as other changes go through form validation
	public function change_course_status(int $course_id, string $status = 'active')
	{
		//checking whether valid course id is provided
		if (!$this->get_coursebyid($course_id)) {
			$this->session->set_flashdata('error', 'invalid course id');
			return FALSE;
		}elseif ($this->auth->user_level != 'admin' ){
			//changing course status is only available for admins
			$this->session->set_flashdata('error', 'you are not authorized to edit this course');
			return FALSE;
		}
        if ($status == 'active' || $status == 'inactive'){
        	$this->db->update('courses', ['status' => $status], ['course_id' => $course_id]);
        	$this->session->set_flashdata('message', 'course has been edited');
        	return TRUE;
        } else {
        	$this->session->set_flashdata('error', 'please recheck the changes');
        	return FALSE;
        }
	}

	public function delete_course(int $course_id)
	{
		//checking whether valid course id is provided
		if ($course = $this->get_coursebyid($course_id)) {
			if ($course->user_id == $this->auth->user_id){
				//Only your own courses can be deleted
	        	$this->db->delete('courses', ['course_id' => $course_id]);
	        	$this->session->set_flashdata('message', 'course has been deleted');
	        	return TRUE;
			} else {
				$this->session->set_flashdata('error', 'you are not authorized to delete this course');
			}
		} else {
			$this->session->set_flashdata('error', 'invalid course id');
		}
        return FALSE;
	}
}