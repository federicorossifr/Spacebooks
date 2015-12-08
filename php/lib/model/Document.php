<?php

/*
The Document Class implements both "model" and "controller" for the entity 'Document' in the web app
*/


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

	private $tags;
	private $picturePath;
	private $files;
	private $avg;
	private $reviews;

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


	public function create() {
		global $db;
		$stmnt = $db->prepare("INSERT INTO document(title,author,description,price,cover) VALUES(?,?,?,?,?)");
		$stmnt->bind_param("sisdi",$this->title,$this->author,$this->description,$this->price,$this->cover);
		$stmnt->execute();
		$this->id = $db->insert_id;
		return $db->insert_id; //return new row's id
	}

	public function update() {
		global $db;
		$stmnt = $db->prepare("UPDATE document SET title=?,created=?,author=?,description=?,price=?,votings=?,score=?,available=?,cover=? WHERE id=?");
		$stmnt->bind_param("ssisdidiii",$this->title,$this->created,
										$this->author,$this->description,$this->price,
										$this->votings,$this->score,$this->available,$this->cover,$this->id);
		$stmnt->execute();
	}

	public function delete() {
		global $db;
		$stmnt = $db->prepare("DELETE FROM document WHERE id=?");
		$stmnt->bind_param("i",$this->id);
		$stmnt->execute();
	}

	private function getFiles() {
		global $db;
		$stmnt = $db->prepare("SELECT F.id,F.name,F.path,F.size,F.created FROM file F INNER JOIN attachments A ON F.Id = A.File INNER JOIN document D ON D.Id = A.Document wHERE D.Id=?");
		$stmnt->bind_param("i",$this->id);
		$stmnt->execute();
		$result = $stmnt->get_result();

		return toArray($result);
	}

	private function getCover() {
		global $db;
		$stmnt = $db->prepare("SELECT path FROM file WHERE id=?");
		$stmnt->bind_param("i",$this->cover);
		$stmnt->execute();
		$result = $stmnt->get_result();
		$row = $result->fetch_assoc();
		return $row['path'];
	}

	public function addFile($fileId) {
		global $db;
		$stmnt = $db->prepare("INSERT INTO attachments(file,document) VALUES(?,?)");
		$stmnt->bind_param("ii",$fileId,$this->id);
		$stmnt->execute();
		return $db->insert_id;
	}	

	private function getRatings() {
		global $db;
		$stmnt = $db->prepare("SELECT * FROM rating WHERE document=?");
		$stmnt->bind_param("i",$this->id);

		$stmnt->execute();
		$result = $stmnt->get_result();

		$resultVector = toArray($result);

		foreach($resultVector as &$res) {
			$res['user'] = User::read($res['user']);
		}

		return $resultVector;
	}

	public function getUserRate($user) {
		global $db;
		$existsReview = $db->prepare("SELECT * FROM rating WHERE document=? AND user=?");
		$existsReview->bind_param("ii",$this->id,$user);
		$existsReview->execute();
		$result = $existsReview->get_result();
		return $result->fetch_assoc();
	}

	public function rate($vote,$comment,$user) {
		global $db;
		$stmnt = null;
		if($this->getUserRate($user)) {
			$stmnt = $db->prepare("UPDATE rating SET opinion =?, score = ? WHERE document=? AND user=?");
			$stmnt->bind_param("siii",$comment,$vote,$this->id,$user);
		} else {
			$stmnt = $db->prepare("INSERT INTO rating(document,user,score,opinion) VALUES(?,?,?,?)");
			$stmnt->bind_param("iiis",$this->id,$user,$vote,$comment);
		}
		
		$stmnt->execute();
		return $db->insert_id;
	}

	public function tag($tag) {
		global $db;
		$readTag = $db->prepare("SELECT * FROM tag WHERE name = ? ");
		$readTag->bind_param("s",$tag);
		$readTag->execute();
		$result = $readTag->get_result();
		$tagId = null;
		if( $result->num_rows ) {
			$existingTag = $result->fetch_assoc();
			print_r($existingTag);
			$tagId = $existingTag['id'];
		} else {
			$newTag = $db->prepare("INSERT INTO tag(name) VALUES(?)");
			$newTag->bind_param("s",$tag);
			$newTag->execute();
			$tagId = $db->insert_id;
		}

		$writeTag = $db->prepare("INSERT INTO tagship(document,tag) VALUES(?,?)");
		$writeTag->bind_param("ii",$this->id,$tagId);
		$writeTag->execute();
	}

	private function getTags() {
		global $db;
		$query = "SELECT name,id FROM tagship INNER JOIN tag ON tag=id WHERE document = ?";
		$stmnt = $db->prepare($query);
		$stmnt->bind_param("i",$this->id);
		$stmnt->execute();
		$result = $stmnt->get_result();
		return toArray($result);
	}

	public function populate() {
		$this->tags = $this->getTags();
		$this->files = $this->getFiles();
		$this->picturePath = $this->getCover();
		$this->avg = ($this->votings > 0) ? $this->score / $this->votings : 0;
		$this->reviews = $this->getRatings();
	}
}

