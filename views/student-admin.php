<!--meta title="Trombinoscope | <?php echo (empty($_GET['id'])?'Nouvel étudiant':'Étudiant : '.$student->getFirstName().' '.$student->getName());?>" css="style/group.css" css="style/student.css" css="style/modal.css" js="script/delete.js"-->
<section id="content" class="admin">
  <figure>
    <img id="result" src="<?php echo ((is_file('data/images/thumbnails/student-'.$student->getId().'.jpg'))?'data/images/thumbnails/student-'.$student->getId().'.jpg':'style/images/nobody.png'); ?>" alt="" />
  </figure>
  <form action="index.php?requ=student<?php if(!empty($_GET['id'])) echo '&id='.$student->getId(); if(!empty($_GET['idGroup'])) echo '&group='.$_GET['idGroup']; ?>" method="post">
	<label form="firstName">Prénom :</label><input id="firstName" type="text" name="firstName" placeholder="Prénom" value="<?php echo $student->getFirstName();?>" /><br />
  	<label for="name">Nom :</label><input id="name" type="text" name="name" placeholder="Nom" value="<?php echo $student->getName();?>" /><br />
  	<label for="group">Groupe :</label>
  	<select id="group" name="group">
	  <option value="" disabled style="display:none;">Groupe :</option>
	  <option value="null"<?php echo (($studentGroup->getId()==null)?' selected':'');?>> </option>
<?php
foreach($groups as $group)
	echo '<option value="'.$group->getId().'" '.(($studentGroup->getId()==$group->getId())?' selected':'').'>'.$group->getName().'</option>';
?>
	</select>
	<br /><input type="submit" value="Enregistrer" /><a href="index.php?requ=student&suppr=<?php echo $student->getId();?>" onclick="supprModal(this); return false" title="supprimer" class="button"><span>Supprimer</span></a>
  </form>
<?php
if($valid) {
	if(!$valid['name'])
		echo '<p class="error">Un nom doit être renseigné</p>';
	if(!$valid['name'])
		echo '<p class="error">Un prénom doit être renseigné</p>';
} ?>
</section>