<!--meta title="Trombinoscope | Selectionner des étudiants" css="style/groups.css" css="style/modal.css" js="script/delete.js"-->
<section id="content">
	<ol>
		<form action="?requ=addStudent&idGroup=<?php echo $_GET['idGroup']?>" method="post" name="addStudent">
		<li><input type="submit" value="Ajouter les étudiants séléctionnés"></li>
		<li><a href="?requ=student&idGroup=<?php echo $_GET['idGroup'] ?>" title="Ajouter un étudiant">Ajouter un étudiant</a></li>
		<?php $emptyGroup = new Group('', ': aucun');
		if(count($students)>0)
		$compt = 0;
		foreach ($students as $student) {
			$group=getGroupByStudent($student);
			if (($group!=null && $group->getId()!=$_GET['idGroup']) || !$group) {
				if(!$group) $group=$emptyGroup;
				echo '<li>'.$student->getName().' '.$student->getFirstName().' |<a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName();
				if($group->getStartDate()!='' && $group->getEndDate()!='')
					echo '<span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
				echo '</a><aside><input type="checkbox" title="Ajouter au groupe" name="options[]" value="'.$student->getId().'"></aside></li>';
				$compt = $compt +1;
			}
		}
		?>
		<li><input type="submit" value="Ajouter les étudiants séléctionnés"><form></li>
	</ol>
    <footer>
		<p><?php
			if($compt>1)
				echo $compt.' étudiants dans un groupe différent';
			else
				echo $compt.' étudiant dans un groupe différent'
		?></p>
	</footer>
</section>