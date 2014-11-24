<?php

class Student {
	private $id;
	private $name, $firstName;

	public function __construct ($id, $name, $firstName) {
		$this->id=$id;
		$this->name=$name;
		$this->firstName=$firstName;
	}

	public function getId () {
		return $this->id;
	}
	public function getName () {
		return $this->name;
	}
	public function getFirstName () {
		return $this->firstName;
	}

	public function setId ($id) {
		$this->id=$id;
	}
	public function setName ($name) {
		$this->name=$name;
	}
	public function setFirstName ($firstName) {
		$this->firstName=$firstName;
	}

	public function __toString () {
		return 'Student [ id : '.$this->id.'; name : '.$this->name.'; firstName : '.$this->firstName.' ]';
	}
}

function getStudents () {
	$students = array();
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM student');
		$statement->execute();
		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$students[]= new Student($rs->idUser, $rs->name, $rs->firstName);
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
	return $students;
}

function getStudentsByGroup ($group) {
	$students = array();
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM student where idGroup=?');
		$statement->bindParam(1, $group->getId());
		$statement->execute();
		while ($rs = $statement->fetch(PDO::FETCH_OBJ))
			$students[]= new Student($rs->idUser, $rs->name, $rs->firstName);
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
	return $students;
}

function getStudentById ($id) {
	$student=null;
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM student WHERE idUser=?');
		$statement->bindParam(1, $id);
		$statement->execute();

		if($rs = $statement->fetch(PDO::FETCH_OBJ))
			$student= new Student($rs->idUser, $rs->name, $rs->firstName);
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
	return $student;
}
?>
