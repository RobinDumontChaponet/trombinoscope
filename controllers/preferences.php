<?php
	$authId=$_SESSION['trombiUser']->getAuth()->getId();
	if($authId==0) {
		include_once('passwordHash.inc.php');
		include_once(MODELS_INC.'User.class.php');

		$admin = getUserByLogin("admin");
		$teacher = getUserByLogin("professeur");

		if(!empty($_POST['pwdTeacher'])) {
			$teacher->setPwd(create_hash($_POST['pwdTeacher']));
			updateUser($teacher);
		}
		if(!empty($_POST['pwdAdmin'])) {
			$admin->setPwd(create_hash($_POST['pwdAdmin']));
			updateUser($admin);
		}
		include(VIEWS_INC.'preferences.php');
	} else
		include(CONTROLLERS_INC.'403.php');
?>