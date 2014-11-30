<?php

define('CONTROLLERS_INC', dirname(__FILE__).'/controllers/');
define('MODELS_INC', dirname(__FILE__).'/models/');
define('VIEWS_INC', dirname(__FILE__).'/views/');
define('STYLE_PATH', dirname(__FILE__).'/style/');

include_once(dirname(__FILE__).'/includes/dbConnection.inc.php');
include_once(MODELS_INC.'User.class.php');

session_start();
if (!isset($_SESSION['trombiUser']) || $_SESSION['trombiUser']=='') {
	header('Location: connection.php');
	exit();
}

set_include_path(dirname(__FILE__).'/includes');

if ($_SESSION['trombiUser']->getAuth()->getId()==0) { // user is Admin

	if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

		include_once(MODELS_INC.'Group.class.php');

		$group = getGroupById($_GET['id']);

		include('mpdf/mpdf.php');

		$mpdf=new mPDF('c');

		$mpdf->SetDisplayMode('fullpage');

		$stylesheet = file_get_contents(STYLE_PATH.'reset.min.css');
		$mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only

		$mpdf->WriteHTML('body {margin:0;padding:0;font-family:"Helvetica Neue","Helvetica","Myriad Set Pro","Lucida Grande","Lucida Sans Unicode","Arial","Verdana","sans-serif"; color:#777; font-weight:200; font-style:normal;font-size:12px; min-width:474px; max-width:1680px} h1{margin: 0 0 14px}', 1);

		$html = '<section id="content">';

		$html.= '	<header><h1>Groupe '.$group->getName();
		if($group->getStartDate()!='' && $group->getEndDate()!='')
			$html.= ' <span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
		$html.= '</h1></header><ul>';

		if(count($group->getStudents())>0)
			foreach($group->getStudents() as $student) {
				$studentUser = getUserById($student->getId());
				$html.= '  <li>'.$student->getName().' '.$student->getFirstName().'<br />login : '.$studentUser->getLogin().'<br />mdp : '.$studentUser->getPwd().'</li><br /><br />';
			}
		$html.= '</ul></section>';
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;

	}

} else
	include(CONTROLLERS_INC.'403.php'); // user is NOT Admin nor Teacher

?>