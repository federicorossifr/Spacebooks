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

	public function __wakeup() {
		$this->refresh();
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
		$stmnt = $db->prepare("SELECT * FROM user WHERE username=?");
		$stmnt->bind_param("s",$username);
		$stmnt->execute();
		$result = $stmnt->get_result();
		$user = $result->fetch_object('User');
		$userHashedPassword = $user->password;
		$authStrategy = new Crypto($password,$userHashedPassword);
		if($authStrategy->doMatch())
			return $user;
		else
			return null;
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
		$stmnt = $db->prepare("SELECT * FROM document WHERE author=?");
		$stmnt->bind_param("i",$this->id);
		$stmnt->execute();
		$result = $stmnt->get_result();
		$documents = array();
		while($row = $result->fetch_object('Document')) {
			$row->populate();
			array_push($documents,$row);
		}
		return $documents;
	}

	function purchase($docId) {
		global $db;
		$stmnt = $db->prepare("INSERT INTO purchase(document,purchaser) VALUES(?,?)");
		$stmnt->bind_param("ii",$docId,$this->id);
		$stmnt->execute();
		return $db->insert_id;
	}

	function refresh() {
		$usr = User::read($this->id);
		foreach($usr as $key => $value) {
			$this->$key = $value;
		}
	}

	function getPurchases() {
		global $db;
		$stmnt = $db->prepare("SELECT * FROM purchase WHERE purchaser=?");
		$stmnt->bind_param("i",$this->id);
		$stmnt->execute();
		$result = $stmnt->get_result();
		$vect =  toArray($result);

		foreach($vect as &$row) {
			$row['document'] = Document::read($row['document']);
			$row['document']->populate();
		}
		return $vect;
	}

	function follow($mate,$unfollow = 0) {
		global $db;
		$stmnt = null;
		$res = $unfollow+1;
		if(!$unfollow)
			$stmnt = $db->prepare("INSERT INTO followship(follower,followed) VALUES(?,?)");
		else
			$stmnt = $db->prepare("DELETE FROM followship WHERE follower = ? AND followed = ?");
		$stmnt->bind_param("ii",$this->id,$mate);
		if($stmnt->execute())
			return $res;
		else
			return 0;
	}

	function getFellows($direction = 1) {
		global $db;
		$stmnt = null;
		if($direction)
			$stmnt = $db->prepare("SELECT * FROM followship INNER JOIN user ON follower = id WHERE followed = ?");
		else
			$stmnt = $db->prepare("SELECT * FROM followship INNER JOIN user ON followed = id WHERE follower = ?");
		$stmnt->bind_param('i',$this->id);
		$stmnt->execute();
		return toArray($stmnt->get_result());
	}
}


