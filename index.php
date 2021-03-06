<?php
define('CONTROLLERS_INC', dirname(__FILE__).'/controllers/');
define('MODELS_INC', dirname(__FILE__).'/models/');
define('VIEWS_INC', dirname(__FILE__).'/views/');

function __autoload($className) {
    include MODELS_INC.$className.'.class.php';
}

include_once(dirname(__FILE__).'/includes/dbConnection.inc.php');

session_start();
if (!isset($_SESSION['trombiUser']) || $_SESSION['trombiUser']=='') {
	header ('Location: connection.php');
	exit();
}

function get_include_contents($filename) {
	if (is_file($filename)) {
		ob_start();
		include ($filename);
		return ob_get_clean();
	}
	return false;
}

set_include_path(dirname(__FILE__).'/includes');

if(empty($_GET['requ']))
	$_GET['requ']='index';

if(is_file(CONTROLLERS_INC.$_GET['requ'].'.php'))
	$inc = get_include_contents(CONTROLLERS_INC.$_GET['requ'].'.php');
else {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	header("Status: 404 Not Found");
	$_SERVER['REDIRECT_STATUS'] = 404;
	$inc = get_include_contents(CONTROLLERS_INC.'404.php');
}

include('datas.transit.inc.php');

preg_match('/<\!--meta\s*(.*)-->/i', $inc, $matches);
if($matches[1]) {
	$link=''; $script=''; $onload='';
	preg_match_all("/(\\S+)=[\"']?((?:.(?![\"']?\\s+(?:\\S+)=|[\"']))+.)[\"']?/", $matches[1], $tag);
	$tag=rearrange($tag);
	foreach($tag as $rule) {
		switch($rule[1]){
			case 'title' : $title=$rule[2]; break;
			case 'css'   : $link.='<link rel="stylesheet" type="text/css" href="'.$rule[2].'"/>'."\n"; break;
			case 'js'    : $script.='<script type="text/javascript" src="'.$rule[2].'"></script>'."\n"; break;
			case 'onload': $onload.=$rule[2].'();'; break;
		}
	}
	if($onload!='') $script.="\n".'<script type="text/javascript">window.onload=function(){'.$onload.'}</script>';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="lt-ie9 lt-ie8 lt-ie7" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 7]>   <html class="lt-ie9 lt-ie8" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 8]>   <html class="lt-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if gt IE 8]><html class="get-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<base href="<?php echo dirname($_SERVER['PHP_SELF']).'/' ?>" />
    <title><?php echo $title; ?></title>
    <!--[if IE]><link rel="shortcut icon" href="style/images/favicon-32.ico"><![endif]-->
	<link rel="icon" href="style/images/favicon-96.png">
	<meta name="msapplication-TileColor" content="#FFF">
	<meta name="msapplication-TileImage" content="style/images/favicon-144.png">
	<link rel="apple-touch-icon" href="style/images/favicon-152.png">
	<link rel="stylesheet" type="text/css" href="style/reset.min.css">
	<link rel="stylesheet" type="text/css" href="style/general.css">
	<?php echo $link; ?>
	<!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<script type="text/javascript" src="script/polyShims.js"></script>
	<script type="text/javascript" src="script/transit.js"></script>
	<?php echo $script; ?>
  </head>
  <body>
    <div id="wrapper">
	  <?php include_once('menu.inc.php');
	  echo $inc; ?>
	</div>
  </body>
</html>