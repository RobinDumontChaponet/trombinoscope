<!--meta title="Trombinoscope | Réglages" css="style/preferences.css"-->
<section id="content" class="admin">

<form action="" method="post">
  <ol>
	<li>
	  <label for="pwdAdmin">Mot-de-passe du compte "<?php echo $admin->getLogin();?>" :</label><input type="password" id="pwdAdmin" name="pwdAdmin" value="" placeholder="Nouveau mot-de-passe">
	</li>
	<li>
	  <label for="pwdTeacher">Mot-de-passe du compte "<?php echo $teacher->getLogin();?>" :</label><input type="password" name="pwdTeacher" value="" placeholder="Nouveau mot-de-passe">
	</li>
  </ol>
  <input type="submit" value="Enregistrer" title="Enregistrer les modifications" />
</form>
</section>