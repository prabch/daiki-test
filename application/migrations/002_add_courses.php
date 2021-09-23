<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_courses extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'course_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL',
                        'modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL',
                        'course_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 198,
                        ),
                        'course_description' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 198,
                                'null' => TRUE,
                        ),
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                        ),
                        'status' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 198,
                        )
                ));
                $this->dbforge->add_key('course_id', TRUE);
                $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(user_id)');
                $this->dbforge->create_table('courses');
        }

        public function down()
        {
                $this->dbforge->drop_table('courses');
        }
}