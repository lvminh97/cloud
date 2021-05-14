<?php
    require_once "Controller/Route.php";
    $route = new Route("ViewController@getIndex");
    // Signup
    $route->get("site", "signup", "ViewController@getSignupPage");
    $route->post("action", "signup", "ActionController@signupAction");
    // Login
    $route->post("action", "loginAct", "ActionController@login");
    $route->get("action", "loginAct", "ViewController@getIndex");
    $route->get("action", "logout", "ActionController@logout");
    // Personal info
    $route->get("action", "load_info", "ActionController@loadInfoAction");
    $route->post("action", "update_info", "ActionController@updateInfoAction");
    $route->post("action", "change_pass", "ActionController@changePassAction");
    // Directory view
    $route->get("site", "dirview", "ViewController@getDirectoryViewPage");
    // Create, upload, rename, delete
    $route->post("action", "create_folder", "ActionController@createFolderAction");
    $route->post("action", "upload_folder", "ActionController@uploadFolderAction");
    $route->post("action", "upload_file", "ActionController@uploadFileAction");
    $route->post("action", "rename_item", "ActionController@renameItemAction");
    $route->post("action", "delete_item", "ActionController@deleteItemAction");
    // Share
    $route->post("action", "get_share_list", "ActionController@getShareListAction");
    $route->post("action", "update_share_mode", "ActionController@updateShareModeAction");
    $route->post("action", "add_privilege", "ActionController@addPrivilegeAction");
    $route->post("action", "remove_privilege", "ActionController@removePrivilegeAction");
    // Download
    $route->get("action", "download", "ActionController@getDownloadAction");
    $route->post("action", "get_file_data", "ActionController@getFileDataAction");

    // $route->get("action", "test", "ActionController@testAction");

    $route->process();
?>