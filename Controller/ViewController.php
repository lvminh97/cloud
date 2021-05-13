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
        $item_id = $_GET['itemid'];
        $check = $this->accountObj->checkLoggedIn();
        if($check != "Role_User"){
            // nextpage("./.");
            $item = $this->itemObj->getItem($item_id);
            if($item['share_mode'] == "mode_public"){
                $itemTitle = getItemName($item['path']);
                $itemList = $this->itemObj->getList("parent_id='$item_id'");
                $parent_id = $item['parent_id'];
                $type = "public";
                if($this->itemObj->getItem($parent_id)['share_mode'] == "mode_public") {
                    array_unshift($itemList, array('item_id' => $parent_id,
                                                'path' => "./..",
                                                'type' => "folder"));
                }
                getView("directory_view", array('title' => 'QCloud',
                                                'itemList' => $itemList,
                                                'itemTitle' => $itemTitle,
                                                'type' => $type));
            }
            else nextpage("./.");
        }
        else{
            $uid = getSession('qcloud_uid');
            if(substr($item_id, 0, 5) == "Root_") $item_id = "root";
            switch($item_id){
                case "share":
                    $itemTitle = "Share with me";
                    $type = "share";
                    $itemList = $this->ownerObj->getShareItemList($uid);
                    break;
                case "root":
                    $itemTitle = "My folders";
                    $type = "own";
                    $itemList = $this->ownerObj->getOwnItemList($uid); break;
                default:
                    $item = $this->itemObj->getItem($item_id);
                    $own = $this->ownerObj->checkOwner(getSession('qcloud_uid'), $item_id);
                    if($own == "owner" || $own == "writeable" || $own == "readonly" || $item['share_mode'] == "mode_public"){
                        if($own != "owner" && $item['share_mode'] != "mode_private") $type = "share";
                        else $type = "own";
                        $itemTitle = getItemName($item['path']);
                        $itemList = $this->itemObj->getList("parent_id='$item_id'");
                        $parent_id = $item['parent_id'];
                        if(substr($parent_id, 0, 5) == "Root_" && $own != "owner"){
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
                                            'itemTitle' => $itemTitle,
                                            'type' => $type));
        }
    }

}
?>