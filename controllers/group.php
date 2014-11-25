<?php
$valid=null;
function validate () {
	$valid = array();
	if (isset($_POST['startDate']) && trim($_POST['startDate'])!='' && (!is_numeric($_POST['startDate']) || strlen($_POST['startDate'])<4 ))
		$valid['startDate'] = 0;
	else
		$valid['startDate'] = 1;
	if (isset($_POST['endDate']) && trim($_POST['endDate'])!='' && (!is_numeric($_POST['endDate']) || strlen($_POST['endDate'])<4 ))
		$valid['endDate'] = 0;
	else
		$valid['endDate'] = 1;
	if (isset($_POST['name']) && trim($_POST['name']) == '')
		$valid['name'] = 0;
	else
		$valid['name'] = 1;
	$valid[0]=$valid['startDate']*$valid['endDate']*$valid['name'];
	return $valid;
}

$authId=$_SESSION['trombiUser']->getAuth()->getId();
if($authId==0 || $authId==2) { // user is Admin or Teacher
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
			if($authId==0) { // user is Admin
				$valid = validate();
				if ($valid[0]) {
					$group = new Group(-1, $_POST['name'], $_POST['startDate'], $_POST['endDate']);
					createGroup($group);
				}
			} else
				include(CONTROLLERS_INC.'403.php');
		}
	} else {
		$group = getGroupById($_GET['id']);
		if(!empty($_POST)) {
			if($authId==0) { // user is Admin
				$valid = validate();
				if ($valid[0]) {
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
	include(CONTROLLERS_INC.'403.php'); // user is NOT Admin or Teacher
?>