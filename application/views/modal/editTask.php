<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Edit Task</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

    <div class="modal-body">
    <form id="editForm">

        <input type="hidden" name="id" id="edit_id">

        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" id="edit_title" name="title">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="edit_description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" id="edit_status" name="status">
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <div class="form-group">
            <label>Due Date</label>
            <input type="date" class="form-control" id="edit_due" name="due_date">
        </div>

        <!-- FILE LIST -->
        <div class="form-group">
            <label>Files</label>
            <ul id="edit_files" class="list-unstyled"></ul>
        </div>

    </form>
</div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" form="editForm" class="btn btn-primary">Update</button>
      </div>

    </div>
  </div>
</div>