<?php

class Group {
	private $id;
	private $name;
	private $date;

	public function __construct ($id, $name, $date) {
		$this->id=$id;
		$this->name=$name;
		$this->date=$date;
	}
	public function __toString () {
		return 'Group [ id : '.$this->id.'; name : '.$this->name.'; date : '.$this->date.']';
	}
}

function getGroups () {
	$groups = array();
	try {
		$connect = connect('mysql:host=infodb2.iut.univ-metz.fr;dbname=dumont28u_trombi');
		$statement = $connect->prepare("SELECT * FROM `group`");

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$groups[]= $rs;
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
	return $groups;
}

?>
