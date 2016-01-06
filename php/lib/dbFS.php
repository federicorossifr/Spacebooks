<?php
	
	$db = require __DIR__ . "/db.php";

	class DbFS {
		private $fsDir;

		function __construct($fsDir) {
			$this->fsDir = $fsDir;

		}

		public static function deleteFile($path) {
			$absolutePath = realpath(BASE_DIR . $path);
			if(file_exists($absolutePath))
				echo unlink($absolutePath);
		}

		function saveFile($file,$sDb = 0) {
			global $db;
			$extension = pathinfo($file['name'],PATHINFO_EXTENSION);
			$filename = basename($file['name'], ".$extension") . date("Ymdhis") . "." . $extension;
			move_uploaded_file($file['tmp_name'], "." . $this->fsDir . $filename);
			$path = $this->fsDir  . $filename;
			if($sDb) {
				$stmnt = $db->prepare("INSERT INTO file(name,path,size,type) VALUES(?,?,?,?)");
				checkQuery($stmnt);
				

				$stmnt->bind_param("ssds",$filename,$path,$file['size'],$file['type']);

				if(!$stmnt->execute()) echo $db->error;
				return $db->insert_id; //return new file's database id
			}

			return $path;

		}

		public static function getFileLink($id) {
			global $db;
			$stmnt = $db->prepare("SELECT path FROM file WHERE id =?");
			checkQuery($stmnt);
			$stmnt->bind_param("i",$id);
			$stmnt->execute();
			$tuple = $stmnt->get_result()->fetch_assoc();
			return $tuple['path'];
		}


		public static function organize(&$file_post) {
	        $file_ary = array();
	        $file_count = count($file_post['name']);
	        $file_keys = array_keys($file_post);

	        for ($i=0; $i<$file_count; $i++) {
	            foreach ($file_keys as $key) {
	                $file_ary[$i][$key] = $file_post[$key][$i];
	            }
	        }

	        return $file_ary;
	}

	}