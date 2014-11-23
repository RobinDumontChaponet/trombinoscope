<!--meta title="Trombinoscope | Importez une image" css="style/group.css" css="style/student.css" css="style/upload.css" js="script/uploadImage.js"-->
<section id="content">
  <figure>
  	<img id="result" src="<?php echo ((is_file('data/images/thumbnails/student-'.$student->getId().'.jpg'))?'data/images/thumbnails/student-'.$student->getId().'.jpg':'style/images/nobody.png'); ?>" alt="" />
  	<figcaption><?php echo $student->getFirstName().' '.$student->getName(); ?></figcaption>
  </figure>
  <div id="file">
        <fieldset id="add" class="button">
            <label>Importez une image...</label> <input type="file" id="fileinput" name="file"> <img src="style/images/loader.gif" alt="chargement...">
        </fieldset>
    </div>
</section>
<script type="text/javascript">
new FileTransfert(document.getElementById('fileinput'), 'student-<?php echo $student->getId(); ?>', 'data/images', function (resp) {
	document.getElementById('result').src=resp.path+'/thumbnails/'+resp.name;
});
</script>