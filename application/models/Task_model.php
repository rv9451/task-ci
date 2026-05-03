<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    private $table = 'tasks';

    public function insert_task($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_tasks_by_user($user_id)
    {
        return $this->db->where('user_id', $user_id)
                        ->order_by('id', 'DESC')
                        ->get($this->table)
                        ->result();
    }
    public function get_task($task_id)
    {
        return $this->db->where('id', $task_id)
                        ->get($this->table)
                        ->row();
    }
}