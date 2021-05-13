<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
    <div class="sidebar-brand-icon">
      <img src="./assets/img/SET_LOGO.jpg" width="50px">
    </div>
    <div class="sidebar-brand-text mx-3">Cloud</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <li class="nav-item">
    <a class="nav-link" href="?site=dirview&itemid=root">
      <i class="fa fa-folder"></i>
      <span>My folders</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="?site=dirview&itemid=share">
      <i class="fa fa-share"></i>
      <span>Share with me</span></a>
  </li>
  <!-- Divider -->
  <!-- <hr class="sidebar-divider d-none d-md-block"> -->
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#createFolderModal">
      <i class="fa fa-folder"></i>
      <span>Create Folder</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#uploadFolderModal">
      <i class="fa fa-upload"></i>
      <span>Upload Folder</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#uploadFileModal">
      <i class="fa fa-upload"></i>
      <span>Upload Files</span></a>
  </li>
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
  <?php getModal("folder.create", $viewParams) ?>
  <?php getModal("folder.upload", $viewParams) ?>
  <?php getModal("file.upload", $viewParams) ?>
  <?php getModal("item.rename", $viewParams) ?>
  <?php getModal("item.delete", $viewParams) ?>
  <?php getModal("share", $viewParams) ?>
</ul>
<!-- End of Sidebar -->