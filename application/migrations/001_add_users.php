<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL',
                        'modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL',
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 198,
                        ),
                        'username' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 198,
                        ),
                        'password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 198,
                        ),
                        'user_level' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 198,
                        ),
                        'status' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 198,
                        )
                ));
                $this->dbforge->add_key('user_id', TRUE);
                $this->dbforge->create_table('users');
        }

        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}