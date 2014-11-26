<!--meta title="Trombinoscope | Étudiants" css="style/groups.css" css="style/modal.css" js="script/delete.js"-->
<section id="content">
  <ol>
  	<li><a href="?requ=student" title="Ajouter un groupe">Ajouter un étudiant</a></li>
<?php $emptyGroup = new Group ('', 'Pas de groupe');
if(count($students)>0)
foreach ($students as $student) {
	$group=getGroupByStudent($student);
	if(!$group) $group=$emptyGroup;
	echo '<li>'.$student->getName().' '.$student->getFirstName().'<a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName();
	if($group->getStartDate()!='' && $group->getEndDate()!='')
		echo '<span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
	echo '</a><aside><a href="?requ=student&id='.$student->getId().'" title="modifier"><span>Modifier</span></a><a href="?requ=student&suppr='.$student->getId().'" onclick="supprModal(this); return false" title="supprimer"><span>Supprimer</span></a></aside></li>';
}
?>
  </ol>
</section>