<?php
	$authId=$_SESSION['trombiUser']->getAuth()->getId();
	if($authId==0) {
		include_once(MODELS_INC.'User.class.php');

		include(VIEWS_INC.'preferences.php');
	} else
		include(CONTROLLERS_INC.'403.php');
?>