<?php
session_start();
if (!isset($_SESSION['trombiUser']) || $_SESSION['trombiUser']=='') {
	exit();
}
include(dirname(__FILE__).'/includes/urls.transit.inc.php');

$possibleDestinations = array('data/csv', 'data/images');
$canSub = array('data/groups');

$extImg = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
$extEmb = array('csv');
$possibleExtensions = array_merge($extImg, $extEmb);

$info=pathinfo($_FILES['upload']['name']);
if($_REQUEST['basename']!='')
	$info['basename']=post_slug($_REQUEST['basename'].'.'.$info['extension']);
else
	$info['basename']=post_slug($info['basename']);

$fileType = $_FILES['upload']['type'];
$destination = $_REQUEST['destination'];

if( !in_array($destination, $possibleDestinations))
	die('bad path ! ;-)');

if( trim($_REQUEST['sub'])!='' ) {
	if( in_array($destination, $canSub) ) {
		if( preg_match('((^\.{2}$)|(^\.{2}\/)|(\/\.{2}\/))', $sub) )
			die('bad path ! ;-)');
		else
			$sub = '/'.$_REQUEST['sub'];
	} else
		die('bad path ! ;-)');
}

if ( in_array(strtolower($info['extension']), $possibleExtensions) ) {

	$fileContent = file_get_contents($_FILES['upload']['tmp_name']);
	if(file_put_contents($destination.$sub.'/'.$info['basename'], $fileContent)!==false) {
		echo json_encode(array(
		  'name' => $info['basename'],
		  'type' => $fileType,
		  'path' => $destination.$sub,
		  'ext' => $info['extension']
		));
	}
} else
	die('unnacepted extension');
?>