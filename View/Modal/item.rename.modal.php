<div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Đổi tên mục</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <span style="display: none;" id="renameItemId"></span>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Tên mục</label>
          <div class="col-sm-9">
            <input type="text" id="renameItemName" name="item_name" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Bỏ qua</button>
        <button class="btn btn-primary" data-dismiss="modal" onclick="renameItem(document.getElementById('renameItemId').innerHTML, document.getElementById('renameItemName').value)">Cập nhật</button>
      </div>
    </div>
  </div>
</div>