<?php

class User {
	private $id
	private $auth;
	private $login;

	public function __construct ($id, $auth, $login) {
		$this->id=$id;
		$this->auth=$auth;
		$this->login=$login;
	}

	public function getId () {
		return $this->id;
	}
	public function getAuth () {
		return $this->auth;
	}
	public function getLogin () {
		return $this->login;
	}

	public function setId ($id) {
		$this->id=$id;
	}
	public function setAuth ($auth) {
		$this->auth=$auth;
	}
	public function setLogin ($login) {
		$this->login=$login;
	}

	public function __toString () {
		return 'User [ id : '.$this->id.'; auth : '.$this->auth.'; login : '.$this->login.']';
	}
}

function getUsers () {
	$users = array();
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM user');

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$users[]=new User($rs->idUser, $rs->auth, $rs->login);
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $users;
}

?>