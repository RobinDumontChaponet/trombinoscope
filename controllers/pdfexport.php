<?php

$idAuth=$_SESSION['trombiUser']->getAuth()->getId();
if($idAuth==0 || $idAuth==2) { // user is Admin or Teacher

	if(!empty($_POST)) {

		include_once(MODELS_INC.'Student.class.php');

		include(VIEWS_INC.'pdfexport.php');

	}

} else
	include(CONTROLLERS_INC.'403.php'); // user is NOT Admin nor Teacher

?>