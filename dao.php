<?php

function getGroups () {
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

function getAuths () {
	$auths = array();
	try {
		$connect = connect('mysql:host=infodb2.iut.univ-metz.fr;dbname=dumont28u_trombi');
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