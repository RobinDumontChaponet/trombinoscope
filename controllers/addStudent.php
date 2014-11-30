<?php

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId == 0) {
	include_once(MODELS_INC.'Group.class.php');

	$students = getStudents();

	include(VIEWS_INC.'addStudent.php');
} else
	include(CONTROLLERS_INC.'403.php');

?>