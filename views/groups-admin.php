<!--meta title="Trombinoscope | Groupes" css="style/groups.css" js="script/delete.js"-->
<section id="content">
  <ol>
  	<li><a href="?requ=addgroup" title="Ajouter un groupe">Ajouter un groupe</a></li>
<?php foreach ($groups as $group)
		  echo '<li><a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName().'<span class="date">('.$group->getDate().')</span></a><aside><a href="?requ=group&id='.$group->getId().'" title="modifier"><span>Modifier</span></a><a href="?requ=suppr&id='.$group->getId().'" onclick="suppr(this); return false" title="supprimer"><span>Supprimer</span></a></aside></li>';
?>
  </ol>
</section>