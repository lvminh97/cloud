<?php
require_once "Controller.php";
class ActionController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function login($loginData){
        $loginResp = $this->accountObj->login($loginData['username'], _hash($loginData['password']));
        if($loginResp == "loginOK") nextpage("./.");
        else notice_and_nextpage("Wrong username or password!", "./.");
    }

    public function logout(){
        $this->accountObj->logout();
        nextpage("./.");
    }

    public function signupAction($data){
        if(trim($data['fullname']) == ""){
			echo "Error: fullname_empty";
		}
		elseif(trim($data['username']) == ""){
			echo "Error: username_empty";
		}
		elseif(!$this->accountObj->checkUsername($data['username'])){
			echo "Error: username_exist";
		}
		elseif($this->accountObj->checkPassword($data['password'], $data['password2']) == "1"){
			echo "Error: password_short";
		}
		elseif($this->accountObj->checkPassword($data['password'], $data['password2']) == "2"){
			echo "Error: password_mismatch";
		}
		else{
			$account_id = $this->accountObj->signup($data['fullname'], $data['email'], $data['username'], sha1(sha1($data['password'])));
			mkdir("./Resource/Root_".$account_id);
			protectFolder("./Resource/Root_".$account_id);
			$item_id = $this->itemObj->addItem("Root_".$account_id, "Root_".$account_id, "folder", "root");
			$this->ownerObj->setOwner($account_id, $item_id, "owner");
			echo "SignupOK";
		}
    }

	public function createFolderAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = $_SESSION['qcloud_uid'];
		//
		if($data['parent_id'] == "root") $parent_id = "Root_".$uid;
		else $parent_id = $data['parent_id'];
		//
		$own = $this->ownerObj->checkOwner($uid, $parent_id);
		if($own == "owner" || $own == "writeable"){
			$item_id = $this->itemObj->createFolder($data['name'], $parent_id, $uid);
			if($item_id != "ExistFolder") {
				// if(substr($parent_id, 0, 5) == "Root_" && substr($parent_id, 5) == $uid) $this->ownerObj->setOwner($uid, $item_id, "owner");
				echo "CreateFolderOK";
			}
			else echo "ExistFolder";
		}
		else{
			echo "NotAllow";
		}
	}

	public function uploadFolderAction($data, $files){
		// $this->itemObj->uploadFolder($files, $data['paths'], "/");
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = $_SESSION['qcloud_uid'];
		//
		if($data['parent_id'] == "root") $parent_id = "Root_".$uid;
		else $parent_id = $data['parent_id'];
		$own = $this->ownerObj->checkOwner($uid, $parent_id);
		if($own == "owner" || $own == "writeable"){
			$this->itemObj->uploadFolder($files, $data['paths'], $this->itemObj->getItem($parent_id)['path']);
			echo "UploadFolderOK";
		}
		else echo "NotAllowUploadFolder";
	}

	public function uploadFileAction($data, $files){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = $_SESSION['qcloud_uid'];
		//
		if($data['parent_id'] == "root") $parent_id = "Root_".$uid;
		else $parent_id = $data['parent_id'];
		$own = $this->ownerObj->checkOwner($uid, $parent_id);
		if($own == "owner" || $own == "writeable"){
			$this->itemObj->uploadFiles($files, $parent_id);
			echo "UploadFileOK";
		}
		else echo "NotAllowUploadFile";
	}

	public function renameItemAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = $_SESSION['qcloud_uid'];
		//
		$own = $this->ownerObj->checkOwner($uid, $data['item_id']);
		if($own == "owner" || $own == "writeable"){
			$this->itemObj->renameItem($data['item_id'], $data['new_name']);
			echo "RenameItemOK";
		}
		else echo "NotAllowRenameItem";
	}

	public function deleteItemAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = $_SESSION['qcloud_uid'];
		//
		$own = $this->ownerObj->checkOwner($uid, $data['item_id']);
		if($own == "owner" || $own == "writeable"){
			$this->ownerObj->removeOwnerByPath($uid, $this->itemObj->getItem($data['item_id'])['path']);
			$this->itemObj->deleteItem($data['item_id']);
			echo "DeleteItemOK";
		}
		else echo "NotAllowDeleteItem";
	}

	public function testAction(){
		// echo $this->ownerObj->checkOwner("vwluf6p601d9yiq00t7n", $data['parent_id'])
	}
}
?>