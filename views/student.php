<!--meta title="Trombinoscope | Ajouter une image" css="style/grid.css"-->
<div id="wrapper">
  <section id="content">
	<div>
		Nom : <?php echo $_SESSION['trombiStudent']->getNom ?>
	</div>
	<div id="file">
		<fieldset id="add" class="button">
			<label>Sélectionnez une image à envoyer</label> <input type="file" id="fileinput" name="file"> <img src="style/images/loader.gif" alt="chargement...">
		</fieldset>
	</div>
  </section>
</div>