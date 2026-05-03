<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/sidebar'); ?>
<?php $this->load->view('modal/addFile'); ?>
<?php $this->load->view('modal/filePreview'); ?>
<?php $this->load->view('modal/editTask'); ?>
<?php $this->load->view('modal/addTask'); ?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-0">Dashboard</h2>
        <p class="mb-0">Welcome, <?= $this->session->userdata('name'); ?></p>
    </div>

    <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addTaskModal">
        <i class="fa fa-plus"></i> Add Task
    </button>
</div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>User Tasks</strong>
        </div>

        <div class="panel-body">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Files</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if(!empty($tasks)): $i=1; foreach($tasks as $task): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $task->title; ?></td>
                        <td><?= $task->description; ?></td>
                        <td>
                            <?php if (!empty($task->files)): ?>
                            <ul class="list-unstyled">
                                <ul class="list-unstyled">
                                    <?php foreach ($task->files as $file): ?>
                                    <li class="d-flex align-items-center gap-2">
                                        <a href="javascript:void(0);"
                                            onclick="previewFile('<?= base_url($file->file_path) ?>')">
                                            <i class="fa fa-eye text-primary"></i>
                                        </a>
                                        <a href="<?= base_url($file->file_path) ?>" target="_blank">
                                            <?= $file->file_name; ?>
                                        </a>

                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php else: ?>
                                <button class="btn btn-outline-primary d-flex align-items-center gap-2 px-4 py-2"
                                    data-bs-toggle="modal" data-bs-target="#uploadModal"
                                    onclick="setTaskId(<?= $task->id ?>)">
                                    <i class="fa fa-upload"></i>
                                    <span>Upload File</span>
                                </button>
                                <?php endif; ?>
                        </td>
                        <td><?= $task->status; ?></td>
                        <td><?= $task->due_date; ?></td>
                        <td>
                            <button class="btn btn-sm btn-info editBtn" data-id="<?= $task->id ?>"
                                data-title="<?= $task->title ?>" data-description="<?= $task->description ?>"
                                data-due="<?= $task->due_date ?>" data-status="<?= $task->status?>" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="fa fa-edit"></i>
                            </button>
                            
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="<?= $task->id ?>">
    <i class="fa fa-trash"></i>
</button>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No tasks found</td>
                    </tr>
                    <?php endif; ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

<?php $this->load->view('layout/footer'); ?>