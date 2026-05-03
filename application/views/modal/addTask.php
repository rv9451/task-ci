<div class="modal fade" id="addTaskModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="addTaskForm" enctype="multipart/form-data">

          <div class="mb-3">
            <label>Title</label>
            <input type="text" class="form-control" name="title" required>
          </div>

          <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" name="description"></textarea>
          </div>

          <div class="mb-3">
            <label>Due Date</label>
            <input type="date" class="form-control" name="due_date">
          </div>
            <div class="mb-3">
            <label>Status</label>
            <select name="status" id="" class="form-control">
                <option value="pending">Pending</option>
                <option value="complete">Complete</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Upload Files</label>
            <input type="file" class="form-control" name="files[]" multiple
                   accept="image/*,application/pdf">
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="addTaskForm" class="btn btn-primary">Save</button>
      </div>

    </div>
  </div>
</div>