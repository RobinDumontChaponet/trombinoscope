<?php
switch ($_SESSION['trombiUser']->getAuth()->getId()) {
	case 0:
		$items = array(
			'trombi/index.php?requ=groups' => '<a href="index.php?requ=groups" title="Voir tous les groupes"><span>Groupes</span></a>',
			'' => '<a href="deconnection.php" title="Se déconnecter"><span>Déconnexion</span></a>'
		);
	break;
	case 1:
		$items = array(
			'' => '<a href="deconnection.php" title="Se déconnecter"><span>Déconnexion</span></a>'
		);
	break;
	case 2:
		$items = array(
			'trombi/index.php?requ=groups' => '<a href="index.php?requ=groups" title="Voir tous les groupes"><span>Groupes</span></a>',
			'' => '<a href="deconnection.php" title="Se déconnecter"><span>Déconnexion</span></a>'
		);
	break;
	default:
		$items=null;
} ?>
<header>
  <nav>
  	<h1>Trombinoscope</h1>
  	<ul>
<?php
foreach($items as $key => $item)
	echo '	  <li'.(($_SERVER['PHP_SELF']==$key)?' class="active"':'').'>'.$item.'</li>'."\n";
?>
	</ul>
  </nav>
</header>