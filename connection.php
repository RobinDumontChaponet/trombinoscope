<?php
$badAgents = array('Java','Jakarta', 'User-Agent', 'compatible ;', 'libwww, lwp-trivial', 'curl, PHP/', 'urllib', 'GT::WWW', 'Snoopy', 'MFC_Tear_Sample', 'HTTP::Lite', 'PHPCrawl', 'URI::Fetch', 'Zend_Http_Client', 'http client', 'PECL::HTTP');
foreach($badAgents as $agent) {
    if(strpos($_SERVER['HTTP_USER_AGENT'],$agent) !== false)
        $bot=true;
}
session_start();
header("HTTP/1.1 200 OK");
if (isset($_SESSION['trombiUser']) && $_SESSION['trombiUser']!='')
	header ('Location: index.php');
elseif (isset($_POST['user']) && isset($_POST['pwd']) && !$bot) {
	$_POST['user']=preg_quote(strip_tags($_POST['user']));
	$_POST['pwd']=preg_quote(strip_tags($_POST['pwd']));
	if ($_POST['user']=='' || $_POST['pwd']=='') $badinput=true;
	else {
		include('includes/dbConnection.inc.php');
		include('includes/passwordHash.inc.php');
		try {
			$connect = connect('mysql:host=infodb2.iut.univ-metz.fr;dbname=dumont28u_trombi');
			$statement = $connect->prepare("SELECT pwd FROM user");

			$statement->execute();

			$res = $statement->fetch(PDO::FETCH_OBJ)->pwd;
		} catch (PDOException $e) {
			die("Error!: " . $e->getMessage() . "<br/>");
		}
		if (!validate_password($_POST['pwd'] , $res)) {
			$badinput=true;
			sleep(1);
		} else {
			session_start();
			$_SESSION['trombiUser']=$_POST['user'];
			session_start();
			header ('Location: index.php');
			exit;
		}
	}
} ?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="lt-ie9 lt-ie8 lt-ie7" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 7]>   <html class="lt-ie9 lt-ie8" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 8]>   <html class="lt-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if gt IE 8]><html class="get-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<head>
<title>Trombinoscope | Connexion</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--[if IE]><link rel="shortcut icon" href="style/favicon-32.ico"><![endif]-->
<link rel="icon" href="style/favicon-96.png">
<meta name="msapplication-TileColor" content="#FFF">
<meta name="msapplication-TileImage" content="style/favicon-144.png">
<link rel="apple-touch-icon" href="style/favicon-152.png">
<link href="style/reset.min.css" rel="stylesheet" type="text/css" />
<link href="style/general.css" rel="stylesheet" type="text/css" />
<link href="style/connection.css" rel="stylesheet" type="text/css" />
</head><body>
<form action="connection.php" method="post" name="connection">
  <fieldset>
  <?php if($bot===true) echo'<p class="mapsitna">Accès interdit !</p>';
else { ?>
    <legend>Trombinoscope</legend>
    <label for="user">Identifiant</label><input title="Identifiant" id="user" name="user" type="text" value="<?php echo $_POST['user']?>" required autofocus />
    <br />
    <label for="pwd">Mot-de-passe</label><input title="Mot-de-passe" id="pwd" name="pwd" type="password" required />
    <br />
    <?php if ($badinput===true) echo'<p class="badpass">Identifiant ou mot-de-passe incorrects !</p>';?>
    <br />
    <input class="<?php if ($badinput!==true) echo'ok'; else echo'warning';?>" name="submit" type="submit" value="&#xe60c; connexion" />
    <!--<br /><a href="#" title="mot de passe oublié ?">mot de passe oublié ?</a>-->
  <?php } ?>
  </fieldset>
</form>
</body>
</html>
