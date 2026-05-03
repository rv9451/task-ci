<div class="modal " id="uploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">

                    <input type="hidden" name="task_id" id="task_id">

                    <div class="form-group">
                        <label>Select Files</label>
                        <input type="file" class="form-control" name="files[]" id="files" multiple
                            accept="image/*,application/pdf">
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="uploadForm" class="btn btn-primary">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>