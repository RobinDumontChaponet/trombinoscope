<?php

if($_SESSION['trombiUser']->getAuth()->getId()==0) { // user is Admin
	include(VIEWS_INC.'csvimport.php');
} else
	include(CONTROLLERS_INC.'403.php'); // user is NOT Admin

?>