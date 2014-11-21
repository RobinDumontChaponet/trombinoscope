<!--meta title="Trombinoscope | Groupe <?php echo $group->getName(); ?>" css="style/grid.css"-->
<div id="wrapper">
  <section id="content">
<?php
	foreach($group->getStudents() as $student)
		echo '<figure><img src="data/images/student-'.$student->getId().'.jpg" alt="" /><figcaption>'.$student->getName().' '.$student->getFirstName().'</figcaption></figure>';
?>
	<figure class="add">
		<a href="?requ=addStudent" title="Ajouter un élève">Ajouter</a>
		<figcaption>
			Ajouter un élève
		</figcaption>
	</figure>
  </section>
</div>