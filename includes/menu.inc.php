<?php
$items = array(
	'trombi/index.php'=>'<a href="index.php" title="Voir tous les groupes"><span>Groupes</span></a>',
	''=>'<a href="deconnection.php" title="Se déconnecter"><span>Déconnexion</span></a>',
); ?>
<nav>
  <ul>
<?php
foreach($items as $key => $item)
	echo '	<li'.(($_SERVER['PHP_SELF']==$key)?' class="active"':'').'>'.$item.'</li>'."\n";
?>
  </ul>
</nav>
