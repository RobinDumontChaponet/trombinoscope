<!--meta title="Trombinoscope | Importez une image" css="style/grid.css" js="script/upload.js"-->
<section id="content">
  <p>Nom : <?php echo $student->getFirstName().' '.$student->getName(); ?></p>
  <img id="result" src="<?php echo ((is_file('data/images/student-'.$student->getId().'.jpg'))?'data/images/student-'.$student->getId().'.jpg':'style/images/nobody.png'); ?>" alt="" />
  <div id="file">
  	<fieldset id="add" class="button">
  	  <label>Importez une image</label> <input type="file" id="fileinput" name="file"><img src="style/images/loader.gif" alt="chargement...">
	</fieldset>
  </div>
</section>
<script type="text/javascript">
new FileTransfert(document.getElementById('fileinput'), 'student-<?php echo $student->getId(); ?>', 'data/images', '', function (resp) {
	document.getElementById('result').src=resp.path+'/'+resp.name;
});
</script>