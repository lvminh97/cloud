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
		elseif(!$this->accountObj->checkEmail($data['email'])){
			echo "Error: email_exist";
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

	public function loadInfoAction(){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = getSession('qcloud_uid');
		$user = $this->accountObj->getItem($uid);
		echo json_encode(array('uid' => $uid, 'username' => $user['username'], 'email' => $user['email'], 'fullname' => $user['fullname']));
	}

	public function updateInfoAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = getSession('qcloud_uid');
		if(trim($data['fullname']) == "") { 
			echo "EmptyFullname"; 
			return; 
		}
		$check = $this->accountObj->getList("email='{$data['email']}' AND uid!='$uid'");
		if(count($check) == 1){
			echo "ExistEmail";
			return;
		}
		$this->accountObj->updateInfo($uid, $data['fullname'], $data['email']);
		echo "UpdateInfoOK";
	}

	public function changePassAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = getSession('qcloud_uid');
		//
		$oldpass = _hash($data['oldpass']);
		$check = $this->accountObj->getList("uid='$uid' AND password='$oldpass'");
		if(count($check) == 0){
			echo "OldPassWrong";
			return;
		}
		if(strlen($data['newpass']) < 8){
			echo "ShortPassword";
			return;
		}
		if($data['newpass'] != $data['newpass2']){
			echo "PasswordMismatch";
			return;
		}
		$this->accountObj->changePassword($uid, _hash($data['newpass']));
		$_SESSION['qcloud_pass'] = _hash($data['newpass']);
		echo "ChangePassOK";
		return;
	}

	public function createFolderAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = getSession('qcloud_uid');
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
		else $uid = getSession('qcloud_uid');
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
		else $uid = getSession('qcloud_uid');
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
		else $uid = getSession('qcloud_uid');
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
		else $uid = getSession('qcloud_uid');
		//
		$own = $this->ownerObj->checkOwner($uid, $data['item_id']);
		if($own == "owner" || $own == "writeable"){
			$this->ownerObj->removeOwnerByPath($uid, $this->itemObj->getItem($data['item_id'])['path']);
			$this->itemObj->deleteItem($data['item_id']);
			echo "DeleteItemOK";
		}
		else echo "NotAllowDeleteItem";
	}

	public function getShareListAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = getSession('qcloud_uid');
		//
		$own = $this->ownerObj->checkOwner($uid, $data['item_id']);
		if($own == "owner"){
			$item = $this->itemObj->getItem($data['item_id']);
			$resp = array();
			$resp['mode'] = $item['share_mode'];
			if($resp['mode'] == "mode_private"){
				$resp['list'] = "null";
			}
			elseif($resp['mode'] == "mode_normal" || $resp['mode'] == "mode_public"){
				$resp['list'] = $this->ownerObj->getShareList($data['item_id']);
				for($i = 0; $i < count($resp['list']); $i++){
					$user = $this->accountObj->getItem($resp['list'][$i]['uid']);
					$resp['list'][$i]['fullname'] = $user['fullname'];
					$resp['list'][$i]['email'] = $user['email'];
				}
			}
			echo json_encode($resp);
		}
		else{
			echo "NotAllowShare";
		}
	}

	public function updateShareModeAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = getSession('qcloud_uid');
		//
		$own = $this->ownerObj->checkOwner($uid, $data['item_id']);
		if($own == "owner"){
			$this->itemObj->setShareMode($data['item_id'], $data['mode']);
			echo "UpdateShareModeOK";
		}
		else echo "NotAllowUpdateShareMode";

	}

	public function addPrivilegeAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = getSession('qcloud_uid');
		//
		$own = $this->ownerObj->checkOwner($uid, $data['item_id']);
		if($own == "owner"){
			$user = $this->accountObj->getList("email='{$data['email']}'");
			if(count($user) == 0) {
				echo "EmailNotFound";
				return;
			}
			$user = $user[0];
			$checkOwn = $this->ownerObj->checkOwner($user['uid'], $data['item_id']);
			if($checkOwn == "writeable" || $checkOwn == "readonly" || $checkOwn == "owner"){
				echo "AlreadyPrivilegeParent";
				return;
			}
			$this->ownerObj->setOwner($user['uid'], $data['item_id'], $data['privilege']);
			echo "AddPrivilegeOK";
		}
		else echo "NotAllowAddPrivilege";
	}

	public function removePrivilegeAction($data){
		if($this->accountObj->checkLoggedIn() != "Role_User") return;
		else $uid = getSession('qcloud_uid');
		//
		$own = $this->ownerObj->checkOwner($uid, $data['item_id']);
		if($own == "owner"){
			$user = $this->accountObj->getList("email='{$data['email']}'");
			if(count($user) == 0) {
				echo "EmailNotFound";
				return;
			}
			$user = $user[0];
			$this->ownerObj->removeOwner($user['uid'], $data['item_id']);
			echo "RemovePrivilegeOK";
		}
		else echo "NotAllowRemovePrivilege";
	}

	public function getDownloadAction(){
		$item_id = $_GET['id'];
		if($this->accountObj->checkLoggedIn() != "Role_User") $uid = "null";
		else $uid = getSession('qcloud_uid');
		//
		$resp = array();
		$item = $this->itemObj->getItem($item_id);
		if($item == "null" || $item['type'] == "folder") {
			return;
		}
		$own = $this->ownerObj->checkOwner($uid, $item_id);
		if($uid == "null" && $item['share_mode'] != "mode_public" /* Not login and not public*/
		|| $uid != "null" && ($own != "owner" && ($item['share_mode'] == "mode_private" || $item['share_mode'] == "mode_normal" && $own != "readonly" && $own != "writeable"))
		){
			return;
		}
		else{
			$resp['code'] = "OK";
			$content = $this->itemObj->getFileContent($item_id);
			header("Content-length: ".$content['size']);
			header("Content-type: application/octet-stream");
			header("Content-disposition: attachment; filename=".$content['filename'].";" );
			echo $content['data'];
			return;
		}
	}

	public function getFileDataAction($data){
		$item = $this->itemObj->getItem($data['file_id']);
		$path = "./Resource/".$item['path'];
		$resp = array('title' => getItemName($path));

		switch ($data['type']) {
			case 'image/jpeg':
			case 'image/png':
			case 'image/x-icon':
				$resp['content'] = "<center><img src=\"$path\" style=\"height: 70vh; width: auto; border: solid #eee;\"></center>";
				break;
			
			case 'text/plain':
			case 'application/octet-stream':
				$tmp = "<div style=\"margin: 10px; border: solid #ddd; background-color: #fff; height: 70vh; max-height: 70vh; overflow-y: scroll;\">";
				$tmp .= "<pre>";
				$file = fopen($path, "r");
				$outText = '';
				while (!feof($file)) {
					$c = fgetc($file);
					if($c == '<') $c = '&lt;';
					$tmp .= $c;
				}
				fclose($file);
				$tmp .= "</pre></div>";
				$resp['content'] = $tmp;
				break;
			case 'application/pdf':
				$resp['content'] = "<center><embed src=\"$path\" style=\"height: 70vh; width: 100%; border: solid #eee;\" /></center>";
				break;
			default:
				$resp['content'] = "";
				break;
		}
		echo json_encode($resp);
	}

	public function testAction(){

	}
}
?>