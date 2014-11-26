<!--meta title="Trombinoscope | Groupes" css="style/groups.css"-->
<section id="content">
	<ol>
		<?php if(count($groups)>0)
			foreach ($groups as $group)
				echo '<li><a href="?requ=group&id='.$group->getId().'" title="Voir le groupe">Groupe '.$group->getName();
				if($group->getStartDate()!='' || $group->getEndDate()!='')
					echo '<span class="date">('.$group->getStartDate().'-'.$group->getEndDate().')</span>';
				echo '</a></li>';
		?>
	</ol>
	<footer>
		<p><?php 
			$grou = count($groups);
			if($grou>1)
				echo $grou.' groupes';
			else
				echo $grou.' groupe'
		?></p>
	</footer>
</section>