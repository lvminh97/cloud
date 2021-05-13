<?php
require_once "functions.php";
require_once "DB.php";

class Item extends DB{
	
	public function __construct(){
		parent::__construct();
	}

	private function genID(){
		$item_id = randString(25);
		$check_id = $this->getList("item_id='$item_id'");
		while(count($check_id) > 0){
			$item_id = randString(25);
			$check_id = $this->getList("item_id='$item_id'");
		}
		return $item_id;
	}

	private function deleteFolder($path){
		foreach(scandir($path) as $file){
			if('.' === $file || '..' === $file){
				continue;
			}
			if(is_dir("$path/$file")){
				$this->deleteFolder("$path/$file");
			}
			else {
				unlink("$path/$file");
			}
		}
		rmdir($path);
	}

	public function createFolder($name, $parent_id, $uid = null){
		if($parent_id == "root") $path = "Root_".$uid."/".$name;
		else $path = $this->getItem($parent_id)['path']."/".$name;
		//
		if(is_dir("Resource/".$path)) return "ExistFolder";
		$item_id = $this->addItem("null", $path, "folder", $parent_id);
		mkdir("Resource/".$path);
		protectFolder("Resource/".$path);
		return $item_id;
	}

	public function uploadFolder($files, $paths, $uploadDir){
		$currentPath = $uploadDir;
		$pathList = explode("##", rtrim($paths));
		foreach($files as $key => $file){
			$path = $pathList[$key];
			$folders = substr($path, 0, strrpos($path, "/"));
			if(strlen($file['name']) != 1){
				// upload
				$folderList = explode("/", $folders);
				$currentPath = $uploadDir;
				foreach($folderList as $folder){
					$currentPath .= "/".$folder;
					if(!is_dir("Resource/".$currentPath)){
						mkdir("Resource/".$currentPath, 0700, true);
						$folder_id = $this->addItem("null", $currentPath, "folder", $this->getItemId(getPreviousPath($currentPath)));
						protectFolder("Resource/".$currentPath);
					}
				}
				if(move_uploaded_file($file['tmp_name'], "Resource/".$currentPath."/".$file['name'])){
					if($this->getItemId($currentPath."/".$file['name']) == "null"){
						$this->addItem("null", $currentPath."/".$file['name'], $file['type'], $this->getItemId($currentPath));
						// return true;
					}
				}
			}
		}
	}

	public function uploadFiles($files, $parent_id){
		$dir = $this->getItem($parent_id)['path'];
		foreach($files as $file){
			if(move_uploaded_file($file['tmp_name'], "Resource/".$dir."/".$file['name'])){
				if($this->getItemId($dir."/".$file['name']) == "null"){
					$this->addItem("null", $dir."/".$file['name'], $file['type'], $parent_id);
				}
			}
		}
	}

	public function getList($cond = "1", $order = ""){
		return $this->select("item", "*", $cond, $order);
	}

	public function getItem($id){
		$tmp = $this->getList("item_id='$id'");
		if(count($tmp) == 1){
			return $tmp[0];
		}
		else{
			return "null";
		}
	}

	public function getItemId($path){
		$tmp = $this->select("item", "item_id", "path='$path'");
		if(count($tmp) == 1) return $tmp[0]['item_id'];
		else return "null";
	}

	public function addItem($id, $path, $type, $parent_id){
		if($id == "null") $item_id = $this->genID();
		else $item_id = $id;
		$this->insert("item", array('item_id' => $item_id,
									'path' => $path,
									'type' => $type,
									'parent_id' => $parent_id,
									'time' => date("Y-m-d H:i:s"),
									'share_mode' => $this->getShareMode($parent_id)));
		return $item_id;
	}

	public function deleteItem($item_id){
		$item = $this->getItem($item_id);
		$path = $item['path'];
		$this->delete("item", "path LIKE '$path/%'"); // remove sub-item in DB
		$this->delete("item", "path='$path'"); // remove item in DB
		if(is_dir("./Resource/".$path)){
			$this->deleteFolder("./Resource/".$path);
		}
		else{
			unlink("./Resource/".$path);
		}
	}

	public function renameItem($item_id, $newName){
		$item = $this->getItem($item_id);
		$path = $item['path'];	
		if(is_dir("./Resource/".$path) && !is_dir("./Resource/".getPreviousPath($path)."/".$newName)
		|| is_file("./Resource/".$path) && !file_exists("./Resource/".getPreviousPath($path)."/".$newName)){
			rename("./Resource/".$path, "./Resource/".getPreviousPath($path)."/".$newName);
			$relatedPathList = $this->getList("path LIKE '%$path/%'");
			foreach($relatedPathList as $relatedPath){
				$newPath = getPreviousPath($path)."/".$newName."/".explode($path."/", $relatedPath['path'])[1];
				$this->update("item", array('path' => $newPath), "path='{$relatedPath['path']}'");
			}
			$this->update("item", array('path' => getPreviousPath($path)."/".$newName), "item_id='$item_id'");
		}
	}

	public function setShareMode($item_id, $mode){
		$item = $this->getItem($item_id);
		$this->update("item", array('share_mode' => $mode), "item_id='$item_id'");
		$this->update("item", array('share_mode' => $mode), "path LIKE '{$item['path']}/%'");
	}

	public function getShareMode($item_id){
		while(true){
			$item = $this->getItem($item_id);
			if($item['share_mode'] == "mode_normal" || $item['share_mode'] == "mode_public") return $item['share_mode'];
			if($item['parent_id'] != "root") $item_id = $item['parent_id'];
			else return "mode_private";
		}
	}

	public function getFileContent($item_id){
		$item = $this->getItem($item_id);
		if($item == "null") $content = "";
		else{
			$content = array();
			$path = "./Resource/".$item['path'];
			$size = filesize($path);
			$fp = fopen($path, "rb");
			$content['data'] = fread($fp, $size);
			$content['filename'] = getItemName($path);
			$content['size'] = $size;
			fclose($fp);
		}
		return $content;
	}
}
?>