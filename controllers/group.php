<?php

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId==0 || $authId==2) {
	include_once(MODELS_INC.'Group.class.php');

	if(empty($_GET['id']))
		$group = new Group();
	else
		if(empty($_POST))
			$group = getGroupById($_GET['id']);
		else {

		}

	include(VIEWS_INC.'group-'.(($authId==0)?'admin':'teacher').'.php');
} else
	include(CONTROLLERS_INC.'403.php');

?>