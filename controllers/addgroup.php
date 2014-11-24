<?php

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId==0) {
	include_once(MODELS_INC.'Group.class.php');

	$group = new Group();

	include(VIEWS_INC.'group-admin.php');
} else
	include(CONTROLLERS_INC.'403.php');

?>