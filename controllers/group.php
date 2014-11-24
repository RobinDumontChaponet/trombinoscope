<?php

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId==0 || $authId==2) {
	include_once(MODELS_INC.'Group.class.php');

	if(empty($_GET['id']))
		$group = new Group();
		if(!empty($_POST)) {

		}
	else
		$group = getGroupById($_GET['id']);
		if(!empty($_POST)) {
			$group->setName = $_POST["name"];
			$group->setDateSring = $_POST["date"];
			updateGroup($group);
		}

	include(VIEWS_INC.'group-'.(($authId==0)?'admin':'teacher').'.php');
} else
	include(CONTROLLERS_INC.'403.php');

?>