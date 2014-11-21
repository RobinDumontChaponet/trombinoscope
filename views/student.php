<!--meta title="Trombinoscope | Ajouter une image" css="style/grid.css"-->
<div id="wrapper">
  <section id="content">
	<div>
		Nom : <?php echo $student->getFirstName().' '.$student->getName(); ?>
	</div>
	<div id="file">
		<fieldset id="add" class="button">
			<label>Importez une image</label> <input type="file" id="fileinput" name="file">
		</fieldset>
	</div>
  </section>
</div>