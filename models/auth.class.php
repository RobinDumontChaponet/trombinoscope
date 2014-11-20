<?php

class Auth {
	private $id
	private $name;

	public function __construct ($id, $name) {
		$this->id=$id;
		$this->name=$name;
		$this->login=$login;
	}
	public function __toString () {
		return 'Auth [ id : '.$this->id.'; name : '.$this->name.' ]';
	}
}

function getAuths () {
	$auths = array();
	try {
		$connect = connect();
		$statement = $connect->prepare("SELECT * FROM auth");

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$auths[]= $rs;
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
	return $auths;
}

?>