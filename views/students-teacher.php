<!--meta title="Trombinoscope | Étudiants" css="style/groups.css"-->
<section id="content">
	<ol>
		<?php $emptyGroup = new Group ('', 'Pas de groupe');
		if(count($students)>0)
			foreach ($students as $student) {
				$group=getGroupByStudent($student);
				if(!$group) $group=$emptyGroup;
				echo '<li>'.$student->getName().' '.$student->getFirstName().'<a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName();
				if($group->getStartDate()!='' && $group->getEndDate()!='')
					echo '<span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
				echo '</a></li>';
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