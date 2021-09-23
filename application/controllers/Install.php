<?php

class Install extends CI_Controller
{

        //This controller migrates the database and create the first admin user to get things started
        public function index()
        {
                $this->load->library('migration');
                if ($this->migration->current() === FALSE) {
                    $this->session->set_flashdata('error', $this->migration->error_string());
                } else {
                    $this->auth_model->create_user([    'name' => 'admin',
                                                        'username' => 'admin',
                                                        'password' => 'password',
                                                        'password_verify' => 'password',
                                                        ], 'admin');
                    redirect('/signin', 'refresh');
                }

        }

}