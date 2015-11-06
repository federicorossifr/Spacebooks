<?php
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
	
	public static function exists($userChoice) {
		global $db;
		$stmnt = $db->prepare("SELECT * FROM user WHERE email = ? OR username = ?");
		$stmnt->bind_param("ss",$userChoice,$userChoice);
		$stmnt->execute();
		$num = $stmnt->get_result()->num_rows;
		return $num;
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


}