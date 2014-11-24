<?php

class Auth {
	private $id;
	private $name;

	public function __construct ($id, $name) {
		$this->id=$id;
		$this->name=$name;
	}

	public function getId () {
		return $this->id;
	}
	public function getName () {
		return $this->name;
	}

	public function setId ($id) {
		$this->id=$id;
	}
	public function setName ($name) {
		$this->name=$name;
	}

	public function __toString () {
		return 'Auth [ id : '.$this->id.'; name : '.$this->name.' ]';
	}
}

function createAuth ($auth) {
	try {
		$connect = connect();
		$statement = $connect->prepare('INSERT INTO auth (idAuth, name) values (?, ?)');
		$statement->bindParam(1, $auth->getId());
		$statement->bindParam(2, $auth->getName());
		$statement->execute();

		return $connect->lastInsertId();
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
}
function updateAuth ($auth) {
	try {
		$connect = connect();
		$statement = $connect->prepare('UPDATE auth SET name=? WHERE idAuth=?');
		$statement->bindParam(1, $auth->getName());
		$statement->bindParam(2, $auth->getId());
		$statement->execute();
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
}
function deleteAuth ($auth) {
	try {
		$connect = connect();
		$statement = $connect->prepare('DELETE FROM auth WHERE idAuth=?');
		$statement->bindParam(1, $auth->getId());
		$statement->execute();
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
}

function getAuths () {
	$auths = array();
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM auth');

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$auths[]= new Auth($rs->idAuth, $rs->name);
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $auths;
}

function getAuthById ($id) {
	$auth = null;
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM auth where idAuth=?');
		$statement->bindParam(1, $id);
		$statement->execute();

		if($rs = $statement->fetch(PDO::FETCH_OBJ))
			$auth= new Auth($rs->idAuth, $rs->name);
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $auth;
}
?>