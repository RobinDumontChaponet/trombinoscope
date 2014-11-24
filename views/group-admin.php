<!--meta title="Trombinoscope | Groupe <?php echo $group->getName(); ?>" css="style/group.css"-->
<section id="content">
<?php
if ($valid != 0)
	echo 'Vous devez renseigner une date de début et de fin sous le format : AAAA - AAAA';
else if ($valid == 2)
	echo 'La date de fin doit être numérique et sous forme : AAAA';
else if ($valid == 3)
	echo 'Un nom de groupe doit être renseigné';
echo '<header><form action="index.php?requ=group&id='.$group->getId().'" method="post"><h1>Groupe <input type="text" name="name" value="'.$group->getName().'" placeholder="Nom du groupe"></h1><span class="date">(<input type="text" name="startDate" value="'.$group->getStartDate().'" placeholder="AAAA">-<input type="text" name="endDate" value="'.$group->getEndDate().'" placeholder="AAAA">)</span><div><input type="submit" value="Enregistrer" title="Enregistrer"><a href="?requ=suppr&id='.$group->getId().'" onclick="suppr(this); return false" title="Supprimer"><span>Supprimer</span></a></div></form></header>';
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
