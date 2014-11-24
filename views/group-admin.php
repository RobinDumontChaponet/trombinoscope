<!--meta title="Trombinoscope | Groupe <?php echo $group->getName(); ?>" css="style/group.css"-->
<section id="content">
<?php
echo '<header><form action = "index.php?requ=group&id='.$group->getId().'"><h1>Groupe <input type="text" value="'.$group->getName().'"></h1><span class="date">(<input type="text" value="'.$group->getDateString().'">)</span><div><input type="submit" value="Enregistrer"><a href="?requ=suppr&id='.$group->getId().'" onclick="suppr(this); return false" title="supprimer"><span>Supprimer</span></a></div></form></header>';
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
