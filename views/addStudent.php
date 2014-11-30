<!--meta title="Trombinoscope | Selectionner des étudiants" css="style/groups.css" css="style/modal.css" js="script/delete.js"-->
<section id="content">
	<ol>
		<li><a href="?requ=student" title="Ajouter un étudiant">Ajouter un étudiant</a></li>
		<?php $emptyGroup = new Group ('', 'Pas de groupe');
		if(count($students)>0)
		foreach ($students as $student) {
			$group=getGroupByStudent($student);
			if(!$group) $group=$emptyGroup;
			echo '<li>'.$student->getName().' '.$student->getFirstName().' |<a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName();
			if($group->getStartDate()!='' && $group->getEndDate()!='')
				echo '<span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
			echo '</a><aside><form><input type="checkbox" name="students[]" value="Ajouter"></form></aside></li>';
		}
		?>
	</ol>
    <footer>
		<p><?php
			$stud = count($students);
			if($stud>1)
				echo $stud.' étudiants';
			else
				echo $stud.' étudiant'
		?></p>
	</footer>
</section>