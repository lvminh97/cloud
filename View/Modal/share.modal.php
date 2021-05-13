<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chia sẻ mục</h5>
                <button id="shareModalClose" class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span style="display: none;" id="shareItemId"></span>
                <div>
                    Chế độ chia sẻ
                    <div style="margin-top: 10px; margin-bottom: 25px; padding-left: 25px;">
                        <input type="radio" name="share_mode" value="modal_public" onclick="document.getElementById('share_list_area').style.display='block'"> Công khai (Bất cứ ai có liên kết đều có thể xem)<br>
                        <input type="radio" name="share_mode" value="modal_normal" onclick="document.getElementById('share_list_area').style.display='block'"> Một số người (Chỉ một số người được cấp quyền mới có thể xem/sửa)<br>
                        <input type="radio" name="share_mode" value="modal_private" onclick="document.getElementById('share_list_area').style.display='none'"> Riêng tư (Chỉ mình người sở hữu mới có thể xem/sửa)<br>
                    </div>
                    <div style="margin-bottom: 30px;">
                        <button class="btn btn-success" style="width: 160px; margin-left: 25px;" onclick="updateShareMode()">Lưu chế độ</button>
                    </div>
                </div>
                <div id="share_list_area">
                    <div id="shareListPanel" style="min-height: 20vh; max-height: 60vh; border: solid #eee; overflow-y: scroll;">

                    </div>
                    <div class="form-group row" style="margin-left: 3px; margin-right: 3px; margin-top: 10px;">
                        <input type="text" id="share_email" class="form-control col-sm-6" style="margin-right: 10px;" autocomplete="off" placeholder="Email">
                        <select class="form-control col-sm-4" id="share_privilege" style="margin-right: 10px; font-weight: bold;">
                            <option value="readonly">Readonly</option>
                            <option value="writeable">Writeable</option>
                        </select>
                        <button class="btn btn-success col-sm-1" onclick="addPrivilege()">
                            <i class="fa fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>