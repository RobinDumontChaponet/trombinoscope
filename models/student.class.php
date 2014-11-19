<?php

class Student {
	private $id
	private $name, $firstName;
	private $group;

	public function __construct ($id, $name, $firstName, $group) {
		$this->id=$id;
		$this->name=$name;
		$this->firstName=$firstName;
		$this->group=$group;
	}
	public function __toString () {
		return 'Student [ id : '.$this->id.'; name : '.$this->name.'; firstName : '.$this->firstName.'; group : '.$this->group.']';
	}
	/*public function conflict ($b) {
		//sqrt(pow($this->x−$b->x,2) + pow($this->y−$b->y,2))<2 &&;
		return ($this->couleur==$b->couleur)?true:false;
	}
	public function distance ($b) {
		return 0; //abs(sqrt(pow($this->x−$b->x,2) + pow($this->y−$b->y,2)));
	}*/
}

function getStudents () {
	$students = array();
	try {
		$connect = connect('mysql:host=infodb2.iut.univ-metz.fr;dbname=dumont28u_trombi');
		$statement = $connect->prepare("SELECT * FROM student");

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$students[]= $rs;
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
	return $students;
}

?>