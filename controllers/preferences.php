<?php
	$authId=$_SESSION['trombiUser']->getAuth()->getId();
	if($authId==0) {
		include_once(MODELS_INC.'User.class.php');

		$admin = getUserByLogin("admin");
		$teacher = getUserByLogin("professeur");

		if(!empty($_POST['pwdTeacher'])) {
			$teacher->setPwd($_POST['pwdTeacher']);
		}
		if(!empty($_POST['pwdAdmin'])) {
			$admin->setPwd($_POST['pwdAdmin']);	// Faire une confirmation et crypter le mdp ?
			//updateUser($admin);
		}
		include(VIEWS_INC.'preferences.php');
	} else
		include(CONTROLLERS_INC.'403.php');
?>