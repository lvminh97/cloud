<?php if (!defined('__CONTROLLER__')) return; ?>
<?php getTemplate("header", $viewParams); ?>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php getTemplate("sidebar", $viewParams); ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php getTemplate("topbar", $viewParams); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">
            <div class="col-12">
              <h5 style="display: block; font-weight: bold; margin-left: 50px; margin-bottom: 20px;">
                <?php echo $viewParams['itemTitle'] ?>
              </h5>

              <div style="display: block; width: 90%; height: 64vh; margin-left: 50px; margin-right: 50px; overflow-y: scroll; background: #fff; border: solid #eee;">
                <div class="table-responsive">
                  <table class="table">
                    <?php
                    if (count($viewParams['itemList']) > 0)
                      foreach ($viewParams['itemList'] as $item) {
                    ?>
                      <tr>
                        <td width="10%">
                          <?php
                          $icon = "./assets/img/";
                          if ($item['type'] == "folder") {
                            $icon .= getItemName($item['path']) != ".." ? "folder.png" : "return.png";
                          } else {
                            $icon .= "file.png";
                          }
                          ?>
                          <img src="<?php echo $icon ?>" width="28">
                        </td>
                        <td width="40%">
                          <?php
                          if ($item['type'] == "folder"){?>
                          <a href="?site=dirview&itemid=<?php echo $item['item_id'] ?>">
                          <?php
                          } else { ?>
                          <a href='#' data-toggle='modal' data-target='#fileViewModal' onclick="fileView('<?php echo $item['item_id'] ?>', '<?php echo $item['type'] ?>')" >
                          <?php 
                          } ?>
                          <?php echo getItemName($item['path']) ?>
                          </a>
                        </td>
                        <td width="10%">
                          <?php
                          if (getItemName($item['path']) != "..") { ?>
                            <div class="dropdown">
                              <button data-toggle="dropdown"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></button>
                              <ul class="dropdown-menu" id="<?php echo "item__" . $item['item_id']; ?>">
                                <?php if ($item['type'] != "folder") { ?>
                                  <li onclick="downloadItem(this)">Tải xuống</li>
                                <?php } ?>
                                <li data-toggle="modal" onclick="setShareItem(this)" data-target="#shareModal">Chia sẻ </li>
                                <li data-toggle="modal" onclick="setRenameItem(this)" data-target="#renameModal">Đổi tên</li>
                                <li data-toggle="modal" onclick="setDeleteItemId(this)" data-target="#deleteModal">Xóa</li>
                              </ul>
                            </div>
                          <?php
                          } ?>
                        </td>
                        <td width="20%"><?php if (getItemName($item['path']) != "..") echo $item['type']; ?></td>
                        <td width="20%"><?php if (getItemName($item['path']) != "..") echo date("H:i:s d/m/Y", filemtime("Resource/" . $item['path'])); ?></td>
                      </tr>
                    <?php
                      } ?>
                    <tr>
                      <td colspan="5" height="150px" style="background-color: transparent;"></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Main Content -->
<?php getTemplate("footer", $viewParams) ?>