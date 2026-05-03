<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table = 'users';

    public function insert_user($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }
}