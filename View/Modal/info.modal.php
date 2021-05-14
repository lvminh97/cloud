<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin cá nhân</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="infoModalBody">
                <div class="form-group">
                    <label for="machine_name">Username</label>
                    <input type="text" class="form-control" id="info_username" style="width: 100%;" disabled>
                </div>
                <div class="form-group">
                    <label for="machine_name">Email</label>
                    <input type="text" class="form-control" id="info_email" style="width: 100%;">
                </div>
                <div class="form-group">
                    <label for="machine_name">Họ tên</label>
                    <input type="text" class="form-control" id="info_fullname" style="width: 100%;">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" onclick="updateInfo(this)">Update</button>
            </div>
        </div>
    </div>
</div>