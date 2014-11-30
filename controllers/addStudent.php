<?php

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId == 0) {

	include_once(MODELS_INC.'Group.class.php');

	$students = getStudents();

	include(VIEWS_INC.'addStudent.php');

	$options = $_POST['options'];
	if (!empty($options)) {
		foreach ($options as $options) {
			$student = new Student();
			$student->setId($options);
			$group = new Group();
			$group->setId($_GET['idGroup']);
			$student->setStudentGroup($group);
			header('Location: index.php?requ=group&id='.$_GET['idGroup']);
		}
	}

} else
	include(CONTROLLERS_INC.'403.php');

?>