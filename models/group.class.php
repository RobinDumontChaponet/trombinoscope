<?php

include_once (dirname(__FILE__).'/../models/student.class.php');

class Group {
	private $id;
	private $name;
	private $date;
	private $students;

	public function __construct ($id, $name, $date, $students=array()) {
		$this->id=$id;
		$this->name=$name;
		$this->date=$date;
	}

	public function getId () {
		return $this->id;
	}
	public function getName () {
		return $this->name;
	}
	public function getDate () {
		return $this->date;
	}
	public function getStudents () {
		return $this->students;
	}

	public function setId ($id) {
		return $this->id=$id;
	}
	public function setName ($name) {
		return $this->name=$name;
	}
	public function setDate ($date) {
		return $this->date=$date;
	}
	public function setStudents ($students) {
		return $this->students=$students;
	}

	public function __toString () {
		return 'Group [ id : '.$this->id.'; name : '.$this->name.'; date : '.$this->date.'; students : '.$this->students.']';
	}
}

function getGroups () {
	$groups = array();
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM `group`');

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ)) {
			$group = new Group($rs->idGroup, $rs->name, $rs->date);
			$group->setStudents(getStudentsByGroup($group));
			$groups[]=$group;
		}
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $groups;
}

function getGroupById ($id) {
	$group=null;
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM `group` where idGroup=?');
		$statement->bindParam(1, $id);
		$statement->execute();

		$rs=$statement->fetch(PDO::FETCH_OBJ);

		$group = new Group($rs->idGroup, $rs->name, $rs->date);
		$group->setStudents(getStudentsByGroup($group));

	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $group;
}

?>
