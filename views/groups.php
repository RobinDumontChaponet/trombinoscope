<!--meta title="Trombinoscope | Groupes"-->
<div id="wrapper">
	<nav>
  		<ul>
	 		<li><a href="deconnection.php" title="Se déconnecter">Déconnexion</a></li>
  		</ul>
	</nav>
	<section id="content">
		<ol>
			<li><a href="?requ=addgroup" title="Ajouter un groupe">Ajouter un groupe</a></li>
			<?php
				foreach ($groups as $group)
					echo '<li>Groupe '.$group->name.'<span><a href="?requ=group&id='.$group->idGroup.'" title="modifier">&#xe601;</a><a href="?requ=suppr&id='.$group->idGroup.'" title="supprimer">&#xe60d;</a></span></li>';
			?>
		</ol>
	</section>
</div>