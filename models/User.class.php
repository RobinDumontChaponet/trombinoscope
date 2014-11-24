<?php

require_once('Auth.class.php');

class User {
	private $id;
	private $login;
	private $pwd;
	private $auth;

	public function __construct ($id, $login, $pwd, $auth) {
		$this->id=$id;
		$this->login=$login;
		$this->pwd=$pwd;
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
	public function getPwd () {
		return $this->pwd;
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
	public function setPwd ($pwd) {
		$this->pwd=$pwd;
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
			$users[]=new User($rs->idUser, $rs->login, getAuthById($rs->idAuth));
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $users;
}

function getUserById ($id) {
	$user = null;
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM user where idUser=?');
		$statement->bindParam(1, $id);
		$statement->execute();

		if($rs = $statement->fetch(PDO::FETCH_OBJ))
			$user=new User($rs->idUser, $rs->login, $rs->pwd, getAuthById($rs->idAuth));
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $user;
}

function getUserByLogin ($login) {
	$user = null;
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM user where login=?');
		$statement->bindParam(1, $login);
		$statement->execute();

		if($rs = $statement->fetch(PDO::FETCH_OBJ))
			$user=new User($rs->idUser, $rs->login, $rs->pwd, getAuthById($rs->idAuth));
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $user;
}

?>