<?php
require_once "functions.php";
require_once "DB.php";

class Account extends DB{

	public function __construct(){
		parent::__construct();
	}

	private function genID(){
		$account_id = randString(20);
		$check_id = $this->getList("uid='$account_id'");
		while(count($check_id) > 0){
			$account_id = randString(20);
			$check_id = $this->getList("uid='$account_id'");
		}
		return $account_id;
	}

	public function getList($cond = "1", $order = ""){
		$list = $this->select("account", "*", $cond, $order);
		return $list;
	}

	public function getItem($account_id){
		$tmp = $this->getList("uid='$account_id'");
		if(count($tmp) == 1) return $tmp[0];
		else return "null";
	}

	public function login($username, $password){
		sessionInit();
		$check = $this->getList("(username='$username' OR email='$username') AND password='$password'");
		if(count($check) == 1){
			$_SESSION['qcloud_user'] = $check[0]['username'];
			$_SESSION['qcloud_pass'] = $password;
			$_SESSION['qcloud_uid']  = $check[0]['uid'];
			return "loginOK";
		}
		else{
			return "loginFailed";
		}
	}

	public function logout(){
		sessionInit();
		unset($_SESSION['qcloud_user']);
		unset($_SESSION['qcloud_pass']);
		unset($_SESSION['qcloud_uid']);
	}

	public function checkLoggedIn(){
		sessionInit();
		if(!isset($_SESSION['qcloud_user']) || !isset($_SESSION['qcloud_pass'])) return "Role_None";
		$check = $this->getList("uid='{$_SESSION['qcloud_uid']}' AND password='{$_SESSION['qcloud_pass']}'");
		if(count($check) != 1){
			$this->logout();
			return "Role_None";
		}
		else{
			return "Role_User";
		}
	}

	public function signup($fullname, $email, $username, $password){
		$uid = $this->genID();
		$this->insert("account", array('uid' => $uid,
										'fullname' => $fullname,
										'email' => $email,
										'username' => $username,
										'password' => $password));
		return $uid;
	}

	public function updateInfo($account_id, $fullname, $email, $mobile){
		// $this->db->execute("UPDATE account SET fullname='$fullname', email='$email', mobile='$mobile' WHERE account_id='$account_id'");
	}

	public function checkUsername($username){
		return count($this->getList("username='$username'")) == 0;
	}

	public function checkEmail($email){
		return count($this->getList("email='$email'")) == 0;
	}

	public function checkPassword($password, $password2){
		if(strlen($password) < 8)
			return 1; // password is too short
		elseif($password != $password2)
			return 2; // password is mismatch
		else
			return 0; // OK
	}

	public function changePassword($account_id, $new_password){
		$this->update("account", array('password' => $new_password), "account_id='$account_id'");
	}

	// public function removeItem($account_id){
	// 	$this->delete("account", "account_id='$account_id'");
	// }
}
?>