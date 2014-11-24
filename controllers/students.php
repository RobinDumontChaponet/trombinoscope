<?php

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId==0 || $authId==2) {

	include_once(MODELS_INC.'Group.class.php');

	$students = getStudents();

	include(VIEWS_INC.'students-'.(($authId==0)?'admin':'teacher').'.php');
} else
	include(CONTROLLERS_INC.'403.php');

?>