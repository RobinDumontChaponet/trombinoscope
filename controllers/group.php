<?php
	$a = array();
function validate () {
	$valid = 1;
	if (!is_numeric($_POST['startDate']))
		$a[0] = 'startDate';
	if (!is_numeric($_POST['endDate']))
		$a[1] = 'endDate';
	if (trim($_POST['name']) == '')
		$a[2] = 'name';
	var_dump($a);
	return $valid;
}

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId==0 || $authId==2) {
	include_once(MODELS_INC.'Group.class.php');

	if(isset($_GET['suppr']) && !empty($_GET['suppr']) && $authId==0) {
		if(isset($_GET['noconfirm'])) {
			deleteGroup(getGroupById($_GET['suppr']));
			header ('Location: index.php?requ=groups');
		} else {
			include(VIEWS_INC.'suppr.php');
		}
	}

	if(!isset($_GET['id']) || empty($_GET['id'])) {
		$group = new Group();
		if(!empty($_POST)) {
			if($authId==0) {
				$valid = validate();
				if ($valid == 0) {
					$group = new Group(-1, $_POST['name'], $_POST['startDate'], $_POST['endDate']);
					createGroup($group);
				}
			} else
				include(CONTROLLERS_INC.'403.php');
		}
	} else {
		$group = getGroupById($_GET['id']);
		if(!empty($_POST)) {
			if($authId==0) {
				$valid = validate();
				if ($valid == 0) {
					$group->setName($_POST["name"]);
					$group->setStartDate($_POST["startDate"]);
					$group->setEndDate($_POST["endDate"]);
					updateGroup($group);
				}
			} else
				include(CONTROLLERS_INC.'403.php');
		}
	}
	include(VIEWS_INC.'group-'.(($authId==0)?'admin':'teacher').'.php');
} else
	include(CONTROLLERS_INC.'403.php');
?>