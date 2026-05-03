<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	 public function __construct()
    {
        parent::__construct();
        $this->load->model('Task_model');
        $this->load->model('User_model');
        $this->load->model('Task_file_model');

        $this->load->library('session');
        $this->load->helper('url');
    }
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function register()
	{
		$this->load->view('auth/register');
	}

	public function register_store()
    {
        $name     = trim($this->input->post('name'));
        $email    = trim($this->input->post('email'));
        $password = $this->input->post('password');
        $confirm  = $this->input->post('confirm_password');

        // Basic validation
        if (empty($name) || empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'All fields are required');
            redirect('auth/register');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('error', 'Invalid email format');
            redirect('auth/register');
        }

        if ($password !== $confirm) {
            $this->session->set_flashdata('error', 'Passwords do not match');
            redirect('auth/register');
        }

        // Check if email already exists
        $existing = $this->User_model->get_user_by_email($email);
        if ($existing) {
            $this->session->set_flashdata('error', 'Email already registered');
            redirect('auth/register');
        }

        // Hash password (IMPORTANT)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'name'       => $name,
            'email'      => $email,
            'password'   => $hashed_password,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->User_model->insert_user($data)) {
            $this->session->set_flashdata('success', 'Registration successful');
				$this->session->set_userdata([
				'user_id' => $this->db->insert_id(),
				'name'    => $name,
				'email'   => $email,
				'logged_in' => TRUE
			]);
			$this->session->set_userdata('run_task_hook', true);
            redirect('dashboard'); // login page
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('auth/register');
        }
    }

	public function login()
	{
		$email    = trim($this->input->post('email'));
		$password = $this->input->post('password');

		if (empty($email) || empty($password)) {
			$this->session->set_flashdata('error', 'Email and password are required');
			redirect('');
		}

		$user = $this->User_model->get_user_by_email($email);
		if ($user && password_verify($password, $user->password)) {
			// Set session data
			$this->session->set_userdata([
				'user_id' => $user->id,
				'name'    => $user->name,
				'email'   => $user->email,
				'logged_in' => TRUE
			]);
			redirect('dashboard'); 
		} else {
			$this->session->set_flashdata('error', 'Invalid email or password');
			redirect('');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
	public function dashboard()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		}
		$user_id = $this->session->userdata('user_id');

    $this->load->model('Task_model');
    $this->load->model('Task_file_model');

    $tasks = $this->Task_model->get_tasks_by_user($user_id);

    // attach files to each task
    foreach ($tasks as $task) {
        $task->files = $this->Task_file_model->get_files_by_task($task->id);
    }

    $data['tasks'] = $tasks;
		$this->load->view('dashboard', $data);
	}


    public function upload_files()
    {
        $task_id = $this->input->post('task_id');

        if (!empty($_FILES['files']['name'][0])) {

            $files = $_FILES;
            $count = count($_FILES['files']['name']);

            for ($i = 0; $i < $count; $i++) {

                $_FILES['file']['name']     = $files['files']['name'][$i];
                $_FILES['file']['type']     = $files['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $files['files']['error'][$i];
                $_FILES['file']['size']     = $files['files']['size'][$i];

                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp|pdf';
                $config['max_size']      = 2048;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {

                    $uploadData = $this->upload->data();

                    $data = [
                        'task_id'   => $task_id,
                        'file_name' => $uploadData['file_name'],
                        'file_path' => 'uploads/' . $uploadData['file_name']
                    ];

                    $this->Task_file_model->insert_file($data);
                }else {
                echo $this->upload->display_errors();
                exit;
            }
            }

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    public function get_files()
    {
        $task_id = $this->input->post('task_id');
        $files = $this->Task_file_model->get_files_by_task($task_id);

        echo json_encode($files);
    }

    public function delete_file()
{
    $id   = $this->input->post('id');
    $path = $this->input->post('path');

    // delete from DB
    $this->db->where('id', $id)->delete('task_files');

    // delete from storage
    $fullPath = FCPATH . $path;

    if (file_exists($fullPath)) {
        unlink($fullPath);
    }

    echo json_encode(['status' => 'success']);
}

public function update()
{
    $id = $this->input->post('id');

    $data = [
        'title'       => $this->input->post('title'),
        'description' => $this->input->post('description'),
        'due_date'    => $this->input->post('due_date'),
        'status'    => $this->input->post('status'),
    ];

    $this->db->where('id', $id);
    $update = $this->db->update('tasks', $data);

    if($update){
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}

public function store()
{
    $this->load->model('Task_model');
    $this->load->model('Task_file_model');
   $user_id = $this->session->userdata('user_id');

    $data = [
        'title'       => $this->input->post('title'),
        'user_id'       => $user_id,
        'description' => $this->input->post('description'),
        'due_date'    => $this->input->post('due_date'),
        'status'    => $this->input->post('status'),
    ];

    // Insert task using model
    $insert = $this->Task_model->insert_task($data);

    if (!$insert) {
        echo json_encode(['status' => 'error', 'msg' => 'Task insert failed']);
        return;
    }

    $task_id = $this->db->insert_id();

    // Upload files
    if (!empty($_FILES['files']['name'][0])) {

        $files = $_FILES;
        $count = count($_FILES['files']['name']);

        for ($i = 0; $i < $count; $i++) {

            $_FILES['file']['name']     = $files['files']['name'][$i];
            $_FILES['file']['type']     = $files['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $files['files']['tmp_name'][$i];
            $_FILES['file']['error']    = $files['files']['error'][$i];
            $_FILES['file']['size']     = $files['files']['size'][$i];

            $config['upload_path']   = FCPATH . 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp|pdf';
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {

                $uploadData = $this->upload->data();

                $fileData = [
                    'task_id'   => $task_id,
                    'file_name' => $uploadData['file_name'],
                    'file_path' => 'uploads/' . $uploadData['file_name']
                ];

                $this->Task_file_model->insert_file($fileData);

            } else {
                // Optional debug
                log_message('error', $this->upload->display_errors());
            }
        }
    }

    echo json_encode(['status' => 'success']);
}

public function delete_task()
{
    $task_id = $this->input->post('id');
    $files = $this->Task_file_model->get_files_by_task($task_id);
    foreach ($files as $file) {
        $fullPath = FCPATH . $file->file_path;

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
    $this->db->where('task_id', $task_id)->delete('task_files');
    $this->db->where('id', $task_id)->delete('tasks');

    echo json_encode(['status' => 'success']);
}
}
