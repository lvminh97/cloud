<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn muốn xóa mục này?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" style="margin-left: auto; margin-right: 10px;">
        <span style="display: none;" id="deleteItemId"></span>
        <button class="btn btn-success" type="button" data-dismiss="modal">Không</button>
        <button class="btn btn-warning" type="button" data-dismiss="modal" onclick="deleteItem(document.getElementById('deleteItemId').innerHTML)">Có</button>
      </div>
    </div>
  </div>
</div>