<?php

if($_SESSION['trombiUser']->getAuth()->getId()==0) { // user is Admin

	if(!empty($_POST)) {
		foreach($_POST as $key => $value) {
			echo 'POST parameter '.$key.' has '.$value;
		}
	} else
		include(VIEWS_INC.'csvimport.php');

} else
	include(CONTROLLERS_INC.'403.php'); // user is NOT Admin

?>