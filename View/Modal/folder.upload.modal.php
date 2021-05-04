<div class="modal fade" id="uploadFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload thư mục</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="file" id="files" name="files[]" multiple webkitdirectory class="form-control" />​
        <div class="progress mb-4">
          <div class="progress-bar" role="progressbar" id="uploadFolderProgress" style="width: 0%; background-color: #1cc88a;"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Bỏ qua</button>
        <button class="btn btn-primary" type="submit" onclick="uploadFolder(document.getElementById('files').files)">Upload</button>
      </div>
    </div>
  </div>
</div>
