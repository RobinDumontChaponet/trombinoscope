<!--meta title="Trombinoscope | Groupes" css="style/groups.css" js="script/delete.js"-->
<section id="content">
  <ol>
  	<li><a href="?requ=group" title="Ajouter un groupe">Ajouter un groupe</a></li>
<?php if(count($groups)>0)
foreach ($groups as $group) {
	echo '<li><a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName();
	if($group->getStartDate()!='' || $group->getEndDate()!='')
		echo '<span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
	echo '</a><aside><a href="?requ=group&id='.$group->getId().'" title="modifier"><span>Modifier</span></a><a href="?requ=group&suppr='.$group->getId().'" onclick="supprModal(this); return false" title="supprimer"><span>Supprimer</span></a></aside></li>';
}
?>
  </ol>
</section>