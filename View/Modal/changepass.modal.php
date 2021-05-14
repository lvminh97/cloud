<div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-5 col-form-label">Old password</label>
          <div class="col-sm-7">
            <input type="password" class="form-control" id="old_pass" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-5 col-form-label">New password</label>
          <div class="col-sm-7">
            <input type="password" class="form-control" id="new_pass" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-5 col-form-label">Retype new password</label>
          <div class="col-sm-7">
            <input type="password" class="form-control" id="new_pass2" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" onclick="updatePassword(this)">Update</button>
      </div>
    </div>
  </div>
</div>