<?php
include_once(dirname(__FILE__).'/models/User.class.php');
session_start();
if (!isset($_SESSION['trombiUser']) || $_SESSION['trombiUser']=='' || $_SESSION['trombiUser']->getAuth()->getId()!=1) {
	exit();
}

include(dirname(__FILE__).'/includes/config.inc.php');
include(dirname(__FILE__).'/includes/urls.transit.inc.php');
include(dirname(__FILE__).'/includes/images.transit.inc.php');


$possibleDestinations = array('data/images');

$possibleExtensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');

$info=pathinfo($_FILES['upload']['name']);
if($_REQUEST['basename']!='')
	$info['basename']=post_slug($_REQUEST['basename']);
else
	$info['basename']=post_slug($info['basename']);

$fileType = $_FILES['upload']['type'];
$destination = $_REQUEST['destination'];

if( !in_array($destination, $possibleDestinations))
	die('bad path ! ;-)');

if ( in_array(strtolower($info['extension']), $possibleExtensions) ) {

	$fileContent = file_get_contents($_FILES['upload']['tmp_name']);

	$tmpImage = imagecreatefromstring($fileContent);

	$first = saveScaledImageRessourceToFile($tmpImage, $destination.'/thumbnails/'.$info['basename'], THUMB_UPLOAD_MAX_WIDTH, THUMB_UPLOAD_MAX_HEIGHT, IMAGE_EXT, JPEG_QUALITY);
	if($first!=0) {
		$saved = true;
		if($first == 2) {
			$scaled = true;
			if(saveScaledImageRessourceToFile($tmpImage, $destination.'/thumbnails/'.$info['basename'], ORIGINAL_UPLOAD_MAX_WIDTH, ORIGINAL_UPLOAD_MAX_HEIGHT, IMAGE_EXT, JPEG_QUALITY)==0) {
				echo 'could not save original image';
				$saved = false;
			}
		} else
			$scaled = false;
	} else {
		$saved = false;
		echo 'could not save image';
	}

	if($saved) {
		echo json_encode(array(
			'name' => $info['basename'].'.'.IMAGE_EXT,
			'type' => $fileType,
			'scaled' => $scaled,
			'path' => $destination,
			'ext' => $info['extension']
		));
	}
} else
	die('unnacepted extension');
?>