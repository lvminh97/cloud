<?php
require_once "Controller.php";
class ViewController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function getIndex(){
        $check = $this->accountObj->checkLoggedIn();
        if($check == "Role_None"){
            getView("login", array('title' => 'QCloud - Đăng nhập'));
        }
        else{
            nextpage("./?site=dirview&itemid=root");
        }
    }

    public function getSignupPage(){
        $check = $this->accountObj->checkLoggedIn();
        if($check == "Role_User"){
            nextpage("./.");
        }
        else{
            getView("signup", array('title' => 'QCloud - Đăng ký'));
        }
    }

    public function getDirectoryViewPage(){
        $check = $this->accountObj->checkLoggedIn();
        if($check != "Role_User"){
            nextpage("./.");
        }
        else{
            $uid = $_SESSION['qcloud_uid'];
            $item_id = $_GET['itemid'];
            if(substr($item_id, 0, 5) == "Root_") $item_id = "root";
            switch($item_id){
                case "share":
                    $itemTitle = "Share with me";
                    $itemList = $this->ownerObj->getShareItemList($uid); break;
                case "root":
                    $itemTitle = "My folders";
                    $itemList = $this->ownerObj->getOwnItemList($uid); break;
                default:
                    $own = $this->ownerObj->checkOwner($_SESSION['qcloud_uid'], $item_id);
                    if($own == "owner" || $own == "writeable" || $own == "readonly"){
                        $itemTitle = getItemName($this->itemObj->getItem($item_id)['path']);
                        $itemList = $this->itemObj->getList("parent_id='$item_id'");
                        $parent_id = $this->itemObj->getItem($item_id)['parent_id'];
                        if($parent_id == "root" && $own != "owner"){
                            $parent_id = "share";
                        }
                        array_unshift($itemList, array('item_id' => $parent_id,
                                            'path' => "./..",
                                            'type' => "folder"));
                    }
                    else {
                        notice_and_nextpage("Bạn không có quyền xem mục này!", "./.");
                    }
                    break;
            }
            getView("directory_view", array('title' => 'QCloud',
                                            'fullname' => $this->accountObj->getItem($uid)['fullname'],
                                            'itemList' => $itemList,
                                            'itemTitle' => $itemTitle));
        }
    }

}
?>