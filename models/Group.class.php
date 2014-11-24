<?php

include_once('Student.class.php');

class Group {
	private $id;
	private $name;
	private $date;
	private $students;

	public function __construct ($id=-1, $name='\'Nouveau\'', $date=' - ', $students=array()) {
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
	public function getDateString () {
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
	public function setDateString ($date) {
		return $this->date=$date;
	}
	public function setStudents ($students) {
		return $this->students=$students;
	}

	public function __toString () {
		return 'Group [ id : '.$this->id.'; name : '.$this->name.'; date : '.$this->date.'; students : '.$this->students.']';
	}
}

function createGroup ($group) {
	try {
		$connect = connect();
		$statement = $connect->prepare('INSERT INTO group (idGroup, name, date) values (?, ?, ?)');
		$statement->bindParam(1, $group->getId());
		$statement->bindParam(2, $group->getName());
		$statement->bindParam(3, $group->getDateString());
		$statement->execute();

		return $connect->lastInsertId();
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
}

function updateGroup ($group) {
	try {
		$connect = connect();
		$statement = $connect->prepare('UPDATE group SET name=?, date=? WHERE idGroup=?');
		$statement->bindParam(1, $group->getName());
		$statement->bindParam(2, $group->getDateString());
		$statement->bindParam(3, $group->getId());
		$statement->execute();
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
}

function deleteGroup ($group) {
	try {
		$connect = connect();
		$statement = $connect->prepare('DELETE FROM group WHERE idGroup=?');
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

		if($rs = $statement->fetch(PDO::FETCH_OBJ)) {
			$group = new Group($rs->idGroup, $rs->name, $rs->date);
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
			$group = new Group($rs->idGroup, $rs->name, $rs->date);
			$group->setStudents(getStudentsByGroup($group));
		}
	} catch (PDOException $e) {
		die('Error!: ' . $e->getMessage() . '<br/>');
	}
	return $group;
}

?>
