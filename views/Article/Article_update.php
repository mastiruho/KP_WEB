<? include ROOT.'/views/layouts/header.php';?>
		<H1>Обновление статьи:</H1>
		<br>
		<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
		<form action = "" method = "post">
		<? for ($i = 0; $i < count($articleItem['Text']); $i++){
			echo "<textarea name='text[]' id='editor".$i."'>".$articleItem['Text'][$i]."</textarea>";
			if ($articleItem['image_file'][$i] !== NULL){
					echo "<div class='image'>";
					echo '<img src ="/'.FOLDER_NAME.'static/images/'.$articleItem['image_file'][$i].'">';
					echo "</div>";
				}
		}
		?>
		<button type="submit" class="button" name="update">Обновление статьи</button>
		</form>
	</BODY>
<script>
<? for ($i = 0; $i < count($articleItem['Text']); $i++){
	echo "CKEDITOR.replace( 'editor".$i."' );";
}
?>
</script>
</HTML>