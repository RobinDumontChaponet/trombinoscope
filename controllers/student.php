<?php

$idAuth = $_SESSION['trombiUser']->getAuth()->getId();
if($idAuth==0) {

	include_once(MODELS_INC.'Student.class.php');

	$student = getStudentById ($_GET['id']);
	$studentGroup = getGroupByStudent ($student);
	$groups = getGroups ();

	include(VIEWS_INC.'student-admin.php');

} elseif($_SESSION['trombiUser']->getAuth()->getId()==1) {

	include_once(MODELS_INC.'Student.class.php');

	if($_SESSION['trombiUser']->getAuth()->getId()==1)
		$student = getStudentById ($_SESSION['trombiUser']->getId());

	include(VIEWS_INC.'student.php');

} else
	include(CONTROLLERS_INC.'403.php');

?>