<div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tạo thư mục mới</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createFolderForm" >
          <input type="hidden" name="parent_id" id="parent-id-create" value="<?php echo $_GET['itemid']; ?>">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tên thư mục</label>
            <div class="col-sm-9">
              <input type="text" name="folder_name" id="folder-name-create" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Bỏ qua</button>
        <button class="btn btn-primary" type="button" onclick="createFolder()">Tạo</button>
      </div>
    </div>
  </div>
</div>