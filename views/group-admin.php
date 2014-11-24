<!--meta title="Trombinoscope | Groupe <?php echo $group->getName(); ?>" css="style/group.css"-->
<section id="content">
<?php
if($valid) {
	if (!$valid['startDate'])
		echo '<p class="error">La date de début doit être numérique et sous forme : AAAA</p>';
	if(!$valid['endDate'])
		echo '<p class="error">La date de fin doit être numérique et sous forme : AAAA</p>';
	if(!$valid['name'])
		echo '<p class="error">Un nom de groupe doit être renseigné</p>';
}
echo '<header><form action="index.php?requ=group&id='.$group->getId().'" method="post"><h1>Groupe <input type="text" name="name" value="'.$group->getName().'" placeholder="Nom du groupe"></h1><span class="date">(<input type="text" name="startDate" maxlength="4" size="4" value="'.$group->getStartDate().'" placeholder="AAAA">-<input type="text" name="endDate" maxlength="4" size="4" value="'.$group->getEndDate().'" placeholder="AAAA">)</span><div><input type="submit" value="Enregistrer" title="Enregistrer"><a href="?requ=suppr&id='.$group->getId().'" onclick="suppr(this); return false" title="Supprimer"><span>Supprimer</span></a></div></form></header>';
?>
  <figure class="add">
	<a href="?requ=addStudent" title="Ajouter un élève">Ajouter</a>
	<figcaption>Ajouter un élève</figcaption>
  </figure>
<?php
if(count($group->getStudents())>0)
	foreach($group->getStudents() as $student)
		echo '  <figure><img src="'.((is_file('data/images/thumbnails/student-'.$student->getId().'.jpg'))?'data/images/thumbnails/student-'.$student->getId().'.jpg':'style/images/nobody.png').'" alt="" /><figcaption>'.$student->getName().' '.$student->getFirstName().'</figcaption></figure>';
?>
</section>
