<!--meta title="Trombinoscope | Groupe <?php echo $group->getName(); ?>" css="style/group.css"-->
<section id="content">
<?php
echo '	<header><h1>Groupe '.$group->getName().'</h1><span class="date">('.$group->getDate().')</span><div><a href="?requ=suppr&id='.$group->getId().'" onclick="suppr(this); return false" title="supprimer"><span>Supprimer</span></a></div></header>';
?>
  <figure class="add">
	<a href="?requ=addStudent" title="Ajouter un élève">Ajouter</a>
	<figcaption>Ajouter un élève</figcaption>
  </figure>
<?php
foreach($group->getStudents() as $student)
	echo '  <figure><img src="'.((is_file('data/images/thumbnails/student-'.$student->getId().'.jpg'))?'data/images/thumbnails/student-'.$student->getId().'.jpg':'style/images/nobody.png').'" alt="" /><figcaption>'.$student->getName().' '.$student->getFirstName().'</figcaption></figure>';
?>
</section>
