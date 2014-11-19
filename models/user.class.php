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
	/*public function conflict ($b) {
		//sqrt(pow($this->x−$b->x,2) + pow($this->y−$b->y,2))<2 &&;
		return ($this->couleur==$b->couleur)?true:false;
	}
	public function distance ($b) {
		return 0; //abs(sqrt(pow($this->x−$b->x,2) + pow($this->y−$b->y,2)));
	}*/
}

function getUsers () {
	$users = array();
	try {
		$connect = connect('mysql:host=infodb2.iut.univ-metz.fr;dbname=dumont28u_trombi');
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