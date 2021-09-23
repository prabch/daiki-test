<?php
class Lecturer_model extends CI_Model {

	public function get_lecturers()
	{
		$query = $this->db->order_by('user_id', 'DESC')->select('user_id, created, modified, name, status')->from('users')->where('user_level', 'lecturer')->get();
		return $query->result();
	}

	public function get_lecturerbyid(int $lecturer_id)
	{
		$query = $this->db->get_where('users', ['user_level' => 'lecturer', 'user_id' => $lecturer_id]);
		return $query->row();
	}

	public function edit_lecturer(int $lecturer_id, string $status = 'active')
	{
		//checking whether a valid lecturer id is provided
		if ($lecturer = $this->get_lecturerbyid($lecturer_id)) {
	        if ($status == 'active' || $status == 'inactive'){
	        	$this->db->update('users', ['status' => $status], ['user_id' => $lecturer_id]);
	        	$this->session->set_flashdata('message', 'lecturer has been edited');
	        	return TRUE;
	        } else {
	        	$this->session->set_flashdata('error', 'please recheck the changes');
	        	return FALSE;
	        }
		}

		//showing an error page if an invalid lecturer id is provided
		$this->session->set_flashdata('error', 'invalid lecturer id');
        return FALSE;
	}
}