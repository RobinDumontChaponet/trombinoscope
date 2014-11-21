<!--meta title="Trombinoscope | Importez une image" css="style/grid.css" js="script/upload.js"-->
<div id="wrapper">
  <section id="content">
	<div>
		Nom : <?php echo $student->getFirstName().' '.$student->getName(); ?>
	</div>
	<img id="result" src="style/images/nobody.png" alt="" />
	<div id="file">
		<fieldset id="add" class="button">
			<label>Importez une image</label> <input type="file" id="fileinput" name="file"><img src="style/images/loader.gif" alt="chargement...">
		</fieldset>
	</div>
  </section>
</div>
<script type="text/javascript">
    new FileTransfert(document.getElementById('fileinput'), 'student-<?php echo $student->getId(); ?>', 'data/images', '', function (resp) {
    	document.getElementById('result').src=resp.path+'/'+resp.name;
    });
</script>