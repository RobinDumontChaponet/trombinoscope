<?php

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId==0 || $authId==2) {
	include_once(MODELS_INC.'Group.class.php');

	if(empty($_GET['id']))
		if(empty($_POST))
			$group = new Group();
		else {

		}
	else
		$group = getGroupById($_GET['id']);
		if(!empty($_POST)) {

		}

	include(VIEWS_INC.'group-'.(($authId==0)?'admin':'teacher').'.php');
} else
	include(CONTROLLERS_INC.'403.php');

?>