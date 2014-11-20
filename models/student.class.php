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
}

function getStudents () {
	$students = array();
	try {
		$connect = connect();
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