<!--meta title="Trombinoscope | Groupe n°" css="style/grid.css"-->
<div id="wrapper">
  <section id="content">
<?php
	foreach($group->getStudents() as $student)
		echo '<figure><img src="data/group-0/student-0.jpg" alt="" /><figcaption>'.$student->getName().' '.$student->getFirstName().'</figcaption></figure>';
?>
	<figure class="add">
		<a href="?requ=ajoutEleve" title="Ajouter un élève">Ajouter</a>
		<figcaption>
			Ajouter un élève
		</figcaption>
	</figure>
  </section>
</div>