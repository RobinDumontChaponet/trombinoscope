<?php

include_once('Student.class.php');

class Group {
	private $id;
	private $name;
	private $startDate;
	private $endDate;
	private $students;

	public function __construct ($id='', $name='', $startDate='', $endDate='', $students=array()) {
		$this->id=$id;
		$this->name=$name;
		$this->startDate=$startDate;
		$this->endDate=$endDate;
	}

	public function getId () {
		return $this->id;
	}
	public function getName () {
		return $this->name;
	}
	public function getStartDate () {
		return $this->startDate;
	}
	public function getEndDate () {
		return $this->endDate;
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
	public function setStartDate ($date) {
		return $this->startDate=$date;
	}
	public function setEndDate ($date) {
		return $this->endDate=$date;
	}
	public function setStudents ($students) {
		return $this->students=$students;
	}

	public function __toString () {
		return 'Group [ id : '.$this->id.'; name : '.$this->name.'; startDate : '.$this->startDate.'; endDate : '.$this->endDate.'; students : '.$this->students.']';
	}
}

function createGroup ($group) {
	try {
		$connect = connect();
		$statement = $connect->prepare('INSERT INTO `group` (idGroup, name, startDate, endDate) values (null, ?, ?, ?)');
		$statement->bindParam(1, $group->getName());
		$statement->bindParam(2, $group->getStartDate());
		$statement->bindParam(3, $group->getEndDate());
		$statement->execute();

		return $connect->lastInsertId();
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
}

function updateGroup ($group) {
	try {
		$connect = connect();
		$statement = $connect->prepare('UPDATE `group` SET name=?, startDate=?, endDate=? WHERE idGroup=?');
		$statement->bindParam(1, $group->getName());
		$statement->bindParam(2, $group->getStartDate());
		$statement->bindParam(3, $group->getEndDate());
		$statement->bindParam(4, $group->getId());
		$statement->execute();
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
}

function deleteGroup ($group) {
	try {
		$connect = connect();
		$statement = $connect->prepare('DELETE FROM `group` WHERE idGroup=?');
		$statement->bindParam(1, $group->getId());
		$statement->execute();
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
}

function getGroups () {
	$groups = array();
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM `group`');

		$statement->execute();

		while ($rs = $statement->fetch(PDO::FETCH_OBJ)) {
			$group = new Group($rs->idGroup, $rs->name, $rs->startDate, $rs->endDate);
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

		if($rs = $statement->fetch(PDO::FETCH_OBJ)) {
			$group = new Group($rs->idGroup, $rs->name, $rs->startDate, $rs->endDate);
			$group->setStudents(getStudentsByGroup($group));
		}
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $group;
}

function getGroupByStudent ($student) {
	$group=null;
	try {
		$connect = connect();
		$statement = $connect->prepare('SELECT * FROM `group` where idGroup=(SELECT idGroup FROM student WHERE idUser=?)');
		$statement->bindParam(1, $student->getId());
		$statement->execute();

		if($rs = $statement->fetch(PDO::FETCH_OBJ)) {
			$group = new Group($rs->idGroup, $rs->name, $rs->startDate, $rs->endDate);
			$group->setStudents(getStudentsByGroup($group));
		}
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $group;
}
?>
