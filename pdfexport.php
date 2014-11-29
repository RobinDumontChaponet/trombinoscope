<?php

define('CONTROLLERS_INC', dirname(__FILE__).'/controllers/');
define('MODELS_INC', dirname(__FILE__).'/models/');
define('VIEWS_INC', dirname(__FILE__).'/views/');
define('STYLE_PATH', dirname(__FILE__).'/style/');

/*function __autoload($className)
{
	include MODELS_INC.$className.'.class.php';
}*/

include_once(dirname(__FILE__).'/includes/dbConnection.inc.php');
include_once(MODELS_INC.'User.class.php');

session_start();
if (!isset($_SESSION['trombiUser']) || $_SESSION['trombiUser']=='')
{
	header('Location: connection.php');
	exit();
}

set_include_path(dirname(__FILE__).'/includes');

$idAuth=$_SESSION['trombiUser']->getAuth()->getId();
if ($idAuth==0 || $idAuth==2) { // user is Admin or Teacher

	if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

		include_once(MODELS_INC.'Student.class.php');


		//============================================================+
		// Inspired from an example by Nicola Asuni. Many thanks to him !
		//============================================================+


		// Include the main TCPDF library (search for installation path).
		include_once('tcpdf.inc.php');

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Trombinoscope - IUT info, Metz');
		$pdf->SetTitle('Trombinoscope, groupe n°');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

		// set header and footer fonts
		//$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		//$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 10);

		// add a page
		$pdf->AddPage();

		/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************/

 		/*$postdata = http_build_query(array('id'=>$_GET['id']));

 		$opts = array('http' => array(
 			'method'  => 'POST',
 			'header'  => 'Content-type: application/x-www-form-urlencoded',
 			'content' => $postdata
 		));
 		$context  = stream_context_create($opts);

 		$html = file_get_contents(CONTROLLERS_INC.'group.php', false, $context);*/

 		function get_include_contents($filename) {
 			if (is_file($filename)) {
 				ob_start();
 				include ($filename);
 				return ob_get_clean();
			}
			return false;
		}

 		//file_get_contents(VIEWS_INC.'../style/group.css'

		// define some HTML content with style
		$html = <<<EOF
<style>
#content header {
	box-shadow: 0 0 4px lightgrey;
	font-size:16px;
	line-height:60px;
	color:#777;
	background:#fff;
	margin:0 0 30px;
	border:1px solid #d3d3d3;
	border-bottom-width:0;
	padding:0 10px;
}
#content header:last-child {
	border-bottom-width:1px;
}
#content header h1 {
	display: inline-block;
}
#content header .date {
	padding-left: 2%;
	color: rgb(181, 181, 181);
}
#content header .date input {
	text-align: center;
	color: rgb(181, 181, 181);
}

#content header aside {
	float:right;
}
#content header aside a, #content header aside input {
	margin-left: 10px;
}

#content {
	-ms-box-orient: horizontal;
	-ms-box-pack: center;
	-webkit-flex-flow: row wrap;
	-moz-flex-flow: row wrap;
	-ms-flex-flow: row wrap;
	flex-flow: row wrap;
	-webkit-justify-content: center;
	-moz-justify-content: center;
	-ms-justify-content: center;
	justify-content: center;
}
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
figure.add {
	border: 4px solid #fff;
	box-shadow: 0 0 8px lightgrey;
}
figure.add a {
	text-indent: -9999px;
	display: inline-block;
}
figure.add a:before{
	content: "\e083";
	font-family: 'icomoon';
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1.45em;
	padding: 0 10px;
	border-radius: 8px;
	cursor: pointer;
	color: #b6b6b6;
	width: 100%;
	font-size: 10em;
	text-align: center;
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	text-indent: 0;
}
figure.add figcaption {
	display: none;
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
}
</style>
EOF;

		$html .= get_include_contents(CONTROLLERS_INC.'group.php');

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('trombinoscope-groupe-.pdf', 'I');


	}

} else
	include(CONTROLLERS_INC.'403.php'); // user is NOT Admin nor Teacher

?>