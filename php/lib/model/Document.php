<?php
class Document {
	private $db;
	private $id;
	private $title;
	private $created;
	private $updated;
	private $author;
	private $description;
	private $price;
	private $score;
	private $votings;
	private $available;
	private $cover;

	function __construct($fields = array()) {
		if($fields) {
			$this->title = $fields['title'];
			$this->author = $fields['author'];
			$this->description = $fields['description'];
			$this->price = $fields['price'];
			$this->cover = isset($fields['cover']) ? $fields['cover'] : null;
		}
	}

	public function __get($property) {
		return $this->$property;
	}

	public function __set($property,$value) {
		$this->$property = $value;
	}

	public static function read($id) {
		global $db;
		$stmnt = $db->prepare("SELECT * FROM document WHERE id=?");
		$stmnt->bind_param('i',$id);
		$stmnt->execute();
		$result = $stmnt->get_result();
		$document = $result->fetch_object('Document');
		return $document;
	}

	public static function fetchAll() {
		global $db;
		$stmnt = $db->prepare("SELECT * FROM document");
		$stmnt->execute();
		$result = $stmnt->get_result();
		$documents = array();

		while($row = $result->fetch_object("Document")) {
			array_push($documents, $row);
		}

		return $documents;
	}


	function create() {
		global $db;
		$stmnt = $db->prepare("INSERT INTO document(title,author,description,price,cover) VALUES(?,?,?,?,?)");
		$stmnt->bind_param("sisdi",$this->title,$this->author,$this->description,$this->price,$this->cover);
		$stmnt->execute();
		$this->id = $db->insert_id;
		return $db->insert_id; //return new row's id
	}

	function update() {
		global $db;
		$stmnt = $db->prepare("UPDATE document SET title=?,created=?,author=?,description=?,price=?,votings=?,score=?,available=?,cover=? WHERE id=?");
		$stmnt->bind_param("ssisdidiii",$this->title,$this->created,
										$this->author,$this->description,$this->price,
										$this->votings,$this->score,$this->available,$this->cover,$this->id);
		$stmnt->execute();
	}

	function delete() {
		global $db;
		$stmnt = $db->prepare("DELETE FROM document WHERE id=?");
		$stmnt->bind_param("i",$this->id);
		$stmnt->execute();

	}

	function getFiles() {
		global $db;
		$stmnt = $db->prepare("SELECT F.id,F.name,F.path,F.size,F.created FROM file F INNER JOIN attachments A ON F.Id = A.File INNER JOIN document D ON D.Id = A.Document wHERE D.Id=?");
		$stmnt->bind_param("i",$this->id);
		$stmnt->execute();
		$result = $stmnt->get_result();

		$files = array();

		while($row = $result->fetch_assoc())
			array_push($files, $row);

		return $files;
	}

	function getCover() {
		global $db;
		$stmnt = $db->prepare("SELECT path FROM file WHERE id=?");
		$stmnt->bind_param("i",$this->cover);
		$stmnt->execute();
		$result = $stmnt->get_result();
		$row = $result->fetch_assoc();
		return $row['path'];
	}

	function addFile($fileId) {
		global $db;
		$stmnt = $db->prepare("INSERT INTO attachments(file,document) VALUES(?,?)");
		$stmnt->bind_param("ii",$fileId,$this->id);
		$stmnt->execute();
		return $db->insert_id;
	}	

	function rate($vote,$comment,$user) {
		global $db;
		$stmnt = $db->prepare("INSERT INTO rating(document,user,score,opinion) VALUES(?,?,?,?)");
		$stmnt->bind_param("iiis",$this->id,$user,$vote,$comment);
		$stmnt->execute();
		return $db->insert_id;
	}
}