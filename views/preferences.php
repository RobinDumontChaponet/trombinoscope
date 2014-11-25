<!--meta title="Trombinoscope | Réglages" css="style/preferences.css"-->
<section id="content" class="admin">

<form action="" method="post">
  <ol>
	<li>
	  <h1>Nom de compte : <?php echo $admin->getLogin();?></h1>
	  <label for="pwdAdmin">Mot de passe :</label><input type="password" id="pwdAdmin" name="pwdAdmin" value="" placeholder="Password">
	</li>
	<li>
	  <h1>Nom de compte : <?php echo $teacher->getLogin();?></h1>
	  <label for="pwdTeacher">Mot de passe :</label><input type="password" name="pwdTeacher" value="" placeholder="Password">
	</li>
  </ol>
  <input type="submit" value="Enregistrer" title="Enregistrer" />
</form>
</section>