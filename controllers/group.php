<?php

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId==0 || $authId==2) {
	include_once(MODELS_INC.'Group.class.php');

	$group = getGroupById($_GET['id']);

	include(VIEWS_INC.'group-'.(($authId==0)?'admin':'teacher').'.php');
} else
	include(CONTROLLERS_INC.'403.php');

?>