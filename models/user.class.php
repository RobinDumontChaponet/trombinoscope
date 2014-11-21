<?php

include_once (dirname(__FILE__).'/../models/auth.class.php');

class User {
	private $id
	private $login;
	private $auth;

	public function __construct ($id, $login, $auth) {
		$this->id=$id;
		$this->login=$login;
		$this->auth=$auth;
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
		return 'User [ id : '.$this->id.'; login : '.$this->login.'; auth : '.$this->auth.' ]';
	}
}

function getUsers () {
	$users = array();
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM user');

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$users[]=new User($rs->idUser, $rs->login, getAuthById($rs->auth));
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $users;
}

?>