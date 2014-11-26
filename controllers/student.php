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
		$studentGroup = new Group();

		if(!empty($_POST)) {
			$valid = validate();
			if ($valid[0]) {
				$student = new Student(-1, $_POST['name'], $_POST['firstName']);
				$idStu = createStudent($student);
				$student->setId($idStu);
				var_dump($student);
				$student->setStudentGroup(getGroupById($_POST['group']));
			}
		}
	} else {
		$student = getStudentById ($_GET['id']);
		$studentGroup = getGroupByStudent ($student);

		if(!empty($_POST)) {
			$valid = validate();
			if ($valid[0]) {
				$student->setName($_POST['name']);
				$student->setFirstName($_POST['firstName']);
				$studentGroup->setId($_POST['group']);
				$student->setStudentGroup($studentGroup);
				updateStudent($student);
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