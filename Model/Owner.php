<?php
require_once "functions.php";
require_once "DB.php";

class Owner extends DB{
	
	public function __construct(){
		parent::__construct();
	}

	public function setOwner($uid, $item_id, $own){
		$this->insert("owner", array('uid' => $uid,
										'item_id' => $item_id,
										'own' => $own));
	}

	public function removeOwner($uid, $item_id){
		$this->delete("owner", "uid='$uid' AND item_id='$item_id'");
	}

	public function removeOwnerByPath($uid, $path){
		$this->delete("owner", "uid='$uid' AND path LIKE '$path/%'");
		$this->delete("owner", "uid='$uid' AND path='$path'");
	}

	public function getShareList($item_id){
		return $this->select("owner", "*", "item_id='$item_id' AND (own='writeable' OR own='readonly')");
	}

	public function getOwnItemList($uid){
		// return $this->select("owner JOIN item", "*", "owner.uid='$uid' AND owner.item_id=item.item_id AND own='owner' AND parent_id='Root_$uid'", "item.path");
		return $this->select("item", "*", "parent_id='Root_$uid'", "time ASC");
	}

	public function getShareItemList($uid){
		return $this->select("owner JOIN item", 
							"*", 
							"owner.uid='$uid' AND owner.item_id=item.item_id AND (own='writeable' OR own='readonly') AND (item.share_mode='mode_public' OR item.share_mode='mode_normal')", 
							"item.time ASC");
	}

	public function checkOwner($uid, $item_id){
		while(true){
			$check = $this->select("owner JOIN item", "*", "owner.uid='$uid' AND owner.item_id=item.item_id AND item.item_id='$item_id'");
			if(count($check) == 1) return $check[0]['own'];
			//
			$item_id_check = $this->select("item", "*", "item_id='$item_id'");
			if(count($item_id_check) == 1) $item_id = $item_id_check[0]['parent_id'];
			else return "NotExist";
			//
		}
		return "NotAllow";
	}
}
?>