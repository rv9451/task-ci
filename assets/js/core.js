
function setTaskId(id) {
    document.getElementById('task_id').value = id;
}

$('#uploadForm').on('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: FILEUPLOADURL,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            console.log(res);
            alert('Files uploaded successfully');
            location.reload(); // refresh table
        },
        error: function(){
            alert('Upload failed');
        }
    });
});
function previewFile(url) {
    let ext = url.split('.').pop().toLowerCase();
    let content = '';

    if (['jpg','jpeg','png','webp','gif'].includes(ext)) {
        content = `<img src="${url}" class="img-responsive" style="max-width:100%;">`;
    } 
    else if (ext === 'pdf') {
        content = `<iframe src="${url}" width="100%" height="500px"></iframe>`;
    } 
    else {
        content = `<p>Preview not available</p>
                   <a href="${url}" target="_blank" class="btn btn-primary">Download</a>`;
    }

    document.getElementById('previewContent').innerHTML = content;

    $('#previewModal').modal('show');
}

$('.editBtn').on('click', function () {

    let id = $(this).data('id');

    $('#edit_id').val(id);
    $('#edit_title').val($(this).data('title'));
    $('#edit_description').val($(this).data('description'));
    $('#edit_due').val($(this).data('due'));
    $('#edit_status').val($(this).data('status'));

    // Load files
    $.ajax({
        url: GETFILEURL,
        type: "POST",
        data: {task_id: id},
        success: function(res) {
            let files = JSON.parse(res);
            let html = '';

            if(files.length > 0){
                files.forEach(file => {
html += `
    <li class="d-flex align-items-center justify-content-between">

        <div>
            <a href="${BaseURL + file.file_path}" target="_blank">
                <i class="fa fa-file"></i> ${file.file_name}
            </a>
        </div>

        <!-- DELETE ICON -->
        <i class="fa fa-times text-danger deleteFileBtn" 
           style="cursor:pointer;"
           data-id="${file.id}" 
           data-path="${file.file_path}">
        </i>

    </li>
`;
                });
            } else {
                html = '<li>No files found</li>';
            }

            $('#edit_files').html(html);
        }
    });

});
$(document).on('click', '.deleteFileBtn', function () {

    if (!confirm('Are you sure to delete this file?')) return;

    let fileId = $(this).data('id');
    let filePath = $(this).data('path');
    let btn = $(this);

    $.ajax({
        url: DELETEFILEURL,
        type: "POST",
        data: {
            id: fileId,
            path: filePath
        },
        success: function (res) {
            console.log(res);

            // remove from UI
            btn.closest('li').remove();
        },
        error: function () {
            alert('Delete failed');
        }
    });

});

$('#editForm').on('submit', function(e){
    e.preventDefault();

    let formData = $(this).serialize();

    $.ajax({
        url: UPDATEURL, 
        type: "POST",
        data: formData,
        success: function(res){
            console.log(res);

            let response = JSON.parse(res);

            if(response.status === 'success'){
                alert('Task updated successfully');
                location.reload(); 
            } else {
                alert('Update failed');
            }
        },
        error: function(){
            alert('Something went wrong');
        }
    });
});

$('#addTaskForm').on('submit', function(e){
    e.preventDefault();

    let isValid = true;

    // remove old errors
    $('.error-msg').remove();

    // check each required field
    $('#addTaskForm [name]').each(function(){
        let value = $(this).val().trim();

        if (value === '') {
            isValid = false;
            $(this).after('<small class="text-danger error-msg">This field is required</small>');
        }
    });

    if (!isValid) return;

    // submit if valid
    let formData = new FormData(this);

    $.ajax({
        url: ADDTASKURL,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            let response = JSON.parse(res);

            if(response.status === 'success'){
                alert('Task added successfully');
                location.reload();
            } else {
                alert('Failed to add task');
            }
        }
    });
});

$(document).on('click', '.deleteBtn', function () {

    if (!confirm('Delete this task and all files?')) return;

    let taskId = $(this).data('id');
    let row = $(this).closest('tr');

    $.ajax({
        url: DELETE_TASK_URL,
        type: "POST",
        data: { id: taskId },
        success: function(res){
            let response = JSON.parse(res);

            if(response.status === 'success'){
                row.remove(); // remove row from UI
            } else {
                alert('Delete failed');
            }
        },
        error: function(){
            alert('Something went wrong');
        }
    });

});