<?php
$valid=null;
function validate () {
	$valid = array();
	if (isset($_POST['name']) && trim($_POST['name']) == '')
		$valid['name'] = 0;
	else
		$valid['name'] = 1;
	if (isset($_POST['firstName']) && trim($_POST['firstName']) == '')
		$valid['firstName'] = 0;
	else
		$valid['firstName'] = 1;
	$valid[0]=$valid['name']*$valid['firstName'];
	return $valid;
}

$idAuth = $_SESSION['trombiUser']->getAuth()->getId();
if($idAuth==0) { // user is Admin

	include_once(MODELS_INC.'Student.class.php');

	$groups = getGroups ();

	if(!isset($_GET['id']) || empty($_GET['id'])) {
		$student = new Student();
		if(!empty($_GET['idGroup']) && is_numeric($_GET['idGroup']))
			$studentGroup=getGroupById($_GET['idGroup']);
		else
			$studentGroup = new Group();

		if(isset($_GET['suppr']) && !empty($_GET['suppr']) && $authId==0) {
			if(isset($_GET['noconfirm'])) {
				$student = new Student($_GET['suppr'], suppr, suppr);
				deleteUser($student);
				deleteStudent($student);
				header ('Location: index.php?requ=students');
			} else {
				include(VIEWS_INC.'suppr.php');
			}
		}
		if(!empty($_POST)) {
			$valid = validate();
			if ($valid[0]) {
				$student = new Student(-1, $_POST['name'], $_POST['firstName']);
				createStudent($student);
				if(is_numeric($_POST['group']))
					$student->setStudentGroup(getGroupById($_POST['group']));

				if(!empty($_GET['idGroup']))
					header ('Location: index.php?requ=group&id='.$_GET['idGroup']);
			}
		}
	} else {
		$student = getStudentById($_GET['id']);
		$studentGroup = getGroupByStudent($student);
		if($studentGroup==null)
			$studentGroup=new Group('', 'Pas de groupe');

		if(!empty($_POST)) {
			$valid = validate();
			if ($valid[0]) {
				$student->setName($_POST['name']);
				$student->setFirstName($_POST['firstName']);
				$studentGroup->setId($_POST['group']);
				echo '<br/><br/>';
				var_dump($_POST['group']);
				echo '<br/><br/>';
				updateStudent($student);
				if($studentGroup->getId())
					$student->setStudentGroup($studentGroup);
			}
		}
	}

	include(VIEWS_INC.'student-admin.php');

} elseif($idAuth==1) { // user is Student

	include_once(MODELS_INC.'Student.class.php');

	$student = getStudentById ($_SESSION['trombiUser']->getId());

	include(VIEWS_INC.'student.php');

} else
	include(CONTROLLERS_INC.'403.php'); // user is NOT Admin or Student

?>