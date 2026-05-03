<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_file_model extends CI_Model {

    private $table = 'task_files';
    public function insert_file($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function get_files_by_task($task_id)
    {
        return $this->db->where('task_id', $task_id)
                        ->order_by('id', 'DESC')
                        ->get($this->table)
                        ->result();
    }
}