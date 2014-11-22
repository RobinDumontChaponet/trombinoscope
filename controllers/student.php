<?php

include(MODELS_INC.'Student.class.php');

//$groups = getGroups();

if($_SESSION['trombiUser']->getAuth()->getId()==1) {
	$student = getStudentById ($_SESSION['trombiUser']->getId());
}

include(VIEWS_INC.'student.php');

?>