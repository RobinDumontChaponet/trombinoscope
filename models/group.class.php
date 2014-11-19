<?php

class Group {
	private $id
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
	/*public function conflict ($b) {
		//sqrt(pow($this->x−$b->x,2) + pow($this->y−$b->y,2))<2 &&;
		return ($this->couleur==$b->couleur)?true:false;
	}
	public function distance ($b) {
		return 0; //abs(sqrt(pow($this->x−$b->x,2) + pow($this->y−$b->y,2)));
	}*/
}

function getSites () {
	$groups = array();
	try {
		$connect = connect('mysql:host=infodb2.iut.univ-metz.fr;dbname=dumont28u_trombi');
		$statement = $connect->prepare("SELECT * FROM group");

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$groups[]= $rs;
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
	return $groups;
}

?>