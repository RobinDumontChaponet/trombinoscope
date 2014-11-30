<!--meta title="Trombinoscope | <?php echo (empty($_GET['id'])?'Nouveau groupe':'Groupe '.$group->getName());?>" css="style/group.css" css="style/modal.css" js="script/delete.js"-->
<section id="content">
<?php
if($valid) {
	if (!$valid['startDate'])
		echo '<p class="error">La date de début doit être numérique et sous forme : AAAA</p>';
	if(!$valid['endDate'])
		echo '<p class="error">La date de fin doit être numérique et sous forme : AAAA</p>';
	if(!$valid['name'])
		echo '<p class="error">Un nom de groupe doit être renseigné</p>';
	if(!$valid['inferior'])
		echo '<p class="error">La date de début doit être supérieure à la date de fin</p>';
	echo '<p>Modification(s) effectuée(s)</p>';
}
echo '<header><form action="index.php?requ=group&id='.$group->getId().'" method="post"><h1>Groupe <input type="text" name="name" value="'.$group->getName().'" placeholder="Nom du groupe"></h1><span class="date">(<input type="text" name="startDate" maxlength="4" size="4" value="'.$group->getStartDate().'" placeholder="AAAA">-<input type="text" name="endDate" maxlength="4" size="4" value="'.$group->getEndDate().'" placeholder="AAAA">)</span><aside><input type="submit" value="Enregistrer" title="Enregistrer" /><a href="?requ=csvimport&id='.$group->getId().'" title="Importer un fichier .csv"><span>Importer .csv</span></a><a href="?requ=group&suppr='.$group->getId().'" onclick="supprModal(this); return false" title="supprimer"><span>Supprimer</span></a></aside></form></header>';
?>
  <figure class="add">
	<a href="?requ=addStudent&idGroup=<?php echo $group->getId();?>" title="Ajouter un élève">Ajouter</a>
	<figcaption>Ajouter un élève</figcaption>
  </figure>
<?php
if(count($group->getStudents())>0)
	foreach($group->getStudents() as $student)
		echo '  <figure><img src="'.((is_file('data/images/thumbnails/student-'.$student->getId().'.jpg'))?'data/images/thumbnails/student-'.$student->getId().'.jpg':'style/images/nobody.png').'" alt="" /><figcaption>'.$student->getName().' '.$student->getFirstName().'</figcaption></figure>';
?>
</section>
