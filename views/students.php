<!--meta title="Trombinoscope | Groupe n°" css="style/grid.css"-->
<div id="wrapper">
  <section id="content">
	<?php
	$students = getStudentsById($_GET['id']);
	foreach($students as $student)
		echo '<figure><img src="data/group-0/student-0.jpg" alt="" /><figcaption>'.$student->name.' '.$student->firstName.'</figcaption></figure>';
	?>
  </section>
</div>