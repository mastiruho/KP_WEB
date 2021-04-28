<? include ROOT.'/views/layouts/header.php';?>
		<H1>Добавление статьи:</H1>
		<br>
		<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
		<script src="/<?echo FOLDER_NAME; ?>static/js/Add.js"></script>
		<form id="form_id" action="" method="post" enctype="multipart/form-data">
			<input type="text" class="articleName" name="Name" placeholder = "Название статьи" maxlength="50" required>
			<br>	
			<textarea name="text[]" id="editor0"></textarea>
			<br>
			<button type="submit" name="submit" id="button_submit">Добавление статьи</button>			
		</form>
		<button id="addImg" onclick="insert(1)">Добавить изображение</button>
		<? if (!$flag):?> 
			<p class="emptyText">Введите текст</p>
		<? endif; ?>
	</BODY>
<script> 
	CKEDITOR.replace( 'editor0' );
</script>
</HTML>