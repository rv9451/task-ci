<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_hook {

    public function create_task_after_register()
    {
        $CI =& get_instance();
        
        // Only run on dashboard requests
        if ($CI->router->class !== 'welcome' || $CI->router->method !== 'dashboard') {
            return;
        }
        
        // Check if flag is set to create task
        if (!$CI->session->userdata('run_task_hook')) {
            return;
        }

        $user_id = $CI->session->userdata('user_id');

        if (!$user_id) {
            return;
        }
        
        // Load model and create task
        $CI->load->model('Task_model');
        $task_data = [
            'user_id'     => $user_id,
            'title'       => 'Welcome Task',
            'description' => 'Complete your profile to get started',
            'status'      => 'pending',
            'due_date'    => date('Y-m-d', strtotime('+3 days')),
            'created_at'  => date('Y-m-d H:i:s')
        ];
        $CI->Task_model->insert_task($task_data);
        
        // Clear the flag so task only gets created once
        $CI->session->unset_userdata('run_task_hook');
    }
}