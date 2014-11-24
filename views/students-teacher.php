<!--meta title="Trombinoscope | Groupe <?php echo $group->getName(); ?>" css="style/group.css"-->
<section id="content">
<?php
echo '	<header><h1>Groupe '.$group->getName().'</h1>';
if($group->getStartDate()!='' && $group->getEndDate()!='')
	echo '<span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
echo '</header>';

if($authId==0) {
?>
  <figure class="add">
	<a href="?requ=addStudent" title="Ajouter un élève">Ajouter</a>
	<figcaption>Ajouter un élève</figcaption>
  </figure>
<?php
}
if(count($group->getStudents())>0)
	foreach($group->getStudents() as $student)
		echo '  <figure><img src="'.((is_file('data/images/thumbnails/student-'.$student->getId().'.jpg'))?'data/images/thumbnails/student-'.$student->getId().'.jpg':'style/images/nobody.png').'" alt="" /><figcaption>'.$student->getName().' '.$student->getFirstName().'</figcaption></figure>';
?>
</section>
