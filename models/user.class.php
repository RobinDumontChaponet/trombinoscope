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
	public function __toString () {
		return 'User [ id : '.$this->id.'; auth : '.$this->auth.'; login : '.$this->login.']';
	}
}

function getUsers () {
	$users = array();
	try {
		$connect = connect();
		$statement = $connect->prepare("SELECT * FROM user");

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$users[]= $rs;
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
	return $users;
}

?>