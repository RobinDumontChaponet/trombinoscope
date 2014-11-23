<!--meta title="Trombinoscope | Groupes" css="style/groups.css"-->
<section id="content">
  <ol>
<?php foreach ($groups as $group)
		  echo '<li><a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName().'<span class="date">('.$group->getDate().')</span></a></li>';
?>
  </ol>
</section>