<?php
	$db = require __DIR__ . "/db.php";

	class User {
		private $id;
		private $username;
		private $password;
		private $email;
		private $name;
		private $surname;
		private $birthdate;
		private $country;
		private $credits;
		private $picture;
		private $role;

		public function __construct($fields = array()) {
			if($fields) {
				$this->username = $fields['username'];
				$this->password = $fields['password'];
				$this->email = $fields['email'];
				$this->name = $fields['name'];
				$this->surname = $fields['surname'];
				$this->birthdate = $fields['birthdate'];
				$this->country = $fields['country'];
			}
		}

		public static function read($id) {
			global $db;
			$stmnt = $db->prepare("SELECT * FROM user WHERE id=?");
			$stmnt->bind_param("i",$id);
			$stmnt->execute();
			$result = $stmnt->get_result();
			$user = $result->fetch_object('User');

			return $user;
		}

		public static function auth($username,$password) {
			global $db;
			$stmnt = $db->prepare("SELECT * FROM user WHERE username=? AND password=?");
			$stmnt->bind_param("ss",$username,$password);
			$stmnt->execute();
			$result = $stmnt->get_result();
			$user = $result->fetch_object('User');
			return $user;
		}

		public static function fetchAll() {
			global $db;
			$stmnt = $db->prepare("SELECT * FROM user");
			$stmnt->execute();
			$result = $stmnt->get_result();
			$users = array();

			while($userObj = $result->fetch_object("User"))
				array_push($users, $userObj);

			return $users;
		}

		public function __set($field,$value) {
			$this->$field = $value;
		}

		public function __get($field) {
			return $this->$field;
		}


		function create() {
			global $db;
			$stmnt = $db->prepare("INSERT INTO user(username,password,email,name,surname,birthdate,country) VALUES(?,?,?,?,?,?,?)");
			$stmnt->bind_param("sssssss",$this->username,$this->password,$this->email,$this->name,$this->surname,$this->birthdate,$this->country);
			$stmnt->execute();

			$this->id = $db->insert_id;
			return $this->id;
		}

		function update() {
			global $db;
			if($stmnt = $db->prepare("UPDATE user SET username=?,password=?,email=?,name=?,surname=?,birthdate=?,country=?,credits=?,picture=?,role=?
									   WHERE id=?")) {
			$stmnt->bind_param("ssssssssssi",$this->username,$this->password,$this->email,$this->name,
										   $this->surname,$this->birthdate,$this->country,
										   $this->credits,$this->picture,$this->role,$this->id);
			$stmnt->execute();}
		}

		function delete() {
			global $db;
			$stmnt = $db->prepare("DELETE FROM user WHERE id=?");
			$stmnt->bind_param("i",$this->id);
			$stmnt->execute();
		}

		function getDocuments() {
			global $db;
			$stmnt = $db->prepare("SELECT * FROM document WHERE author=? AND available = 1");
			$stmnt->bind_param("i",$this->id);
			$stmnt->execute();
			$result = $stmnt->get_result();
			$documents = array();
			
			while($row = $result->fetch_object('Document')) {
				array_push($documents,$row);
			}
			return $documents;
		}

		public static function exists($userChoice) {
			global $db;
			$stmnt = $db->prepare("SELECT * FROM user WHERE email = ? OR username = ?");
			$stmnt->bind_param("ss",$userChoice,$userChoice);
			$stmnt->execute();
			$num = $stmnt->get_result()->num_rows;
			return $num;
		}

	}

	class Document {
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

		function getFileLinks() {
			global $db;
			$stmnt = $db->prepare("SELECT F.id,F.name,F.path,F.size,F.created FROM file F INNER JOIN attachments A ON F.Id = A.File INNER JOIN document D ON D.Id = A.Document wHERE D.Id=?");
			$stmnt->bind_param("i",$this->id);
			$stmnt->execute();
			$result = $stmnt->get_result();

			$links = array();

			while($row = $result->fetch_assoc())
				array_push($links, $row);

			return $links;
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

