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

$idAuth=$_SESSION['trombiUser']->getAuth()->getId();
if ($idAuth==0 || $idAuth==2) { // user is Admin or Teacher

	if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

		include_once(MODELS_INC.'Group.class.php');

		$group = getGroupById($_GET['id']);

		include('mpdf/mpdf_source.php');

 		function get_include_contents($filename) {
 			if (is_file($filename)) {
 				ob_start();
 				include ($filename);
 				return ob_get_clean();
			}
			return false;
		}

		$mpdf=new mPDF('c');

		$mpdf->SetDisplayMode('fullpage');

		$stylesheet = file_get_contents(STYLE_PATH.'reset.min.css');
		$mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only

		$mpdf->WriteHTML('body {font-family:"Helvetica Neue","Helvetica","Myriad Set Pro","Lucida Grande","Lucida Sans Unicode","Arial","Verdana","sans-serif"; color:#777; font-weight:200; font-style:normal;font-size:100%; min-width:474px; max-width:1680px} figure {float: left}
figure {
	-webkit-flex: 1;
	-moz-flex: 1;
	-ms-flex: 1;
	flex: 1;
}

figure {
	width: 200px;
	height: 250px;
	display: inline-block;
	margin: 1% 1% 28px;
	vertical-align: middle;
	text-align: center;
	position: relative;
}
figure img {
	width: 100%;
	max-height: 100%;
	border: 4px solid #fff;
	box-shadow: 0 0 8px lightgrey;
}
figcaption {
	font-size: 14px;
	line-height: 14px;
	position: absolute;
	left: 0;
	right: 0;
	top: 100%;
	margin-top: 5px;
}', 1);

		$html = '<section id="content">';

		$html.= '	<header><h1>Groupe '.$group->getName();
		if($group->getStartDate()!='' && $group->getEndDate()!='')
			$html.= '<span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
		$html.= '</h1></header>';

		if(count($group->getStudents())>0)
			foreach($group->getStudents() as $student)
				$html.= '  <figure><img src="'.((is_file('data/images/thumbnails/student-'.$student->getId().'.jpg'))?'data/images/thumbnails/student-'.$student->getId().'.jpg':'style/images/nobody.png').'" alt="" /><figcaption>'.$student->getName().' '.$student->getFirstName().'</figcaption></figure>';
		$html.= '</section>';
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;

	}

} else
	include(CONTROLLERS_INC.'403.php'); // user is NOT Admin nor Teacher

?>