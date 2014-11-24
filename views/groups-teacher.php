<!--meta title="Trombinoscope | Groupes" css="style/groups.css"-->
<section id="content">
  <ol>
<?php if(count($groups)>0)
	foreach ($groups as $group)
		echo '<li><a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName().'<span class="date">('.$group->getDateString().')</span></a></li>';
?>
  </ol>
</section>