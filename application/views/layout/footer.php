</div> <!-- main-content -->
<script>
    let FILEUPLOADURL = "<?= base_url('task/upload_files') ?>";
    let GETFILEURL = "<?= base_url('task/get_files') ?>";
    let BaseURL = `<?= base_url()?>`;
    const DELETEFILEURL = "<?= base_url('task/delete_file') ?>";
    const UPDATEURL = "<?= base_url('task/update') ?>";
    const ADDTASKURL = "<?= base_url('task/store') ?>";

    const DELETE_TASK_URL = "<?= base_url('welcome/delete_task') ?>";

</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('assets/js/core.js') ?>"></script> 
  
</body>
</html>