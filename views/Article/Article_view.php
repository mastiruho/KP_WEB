<? include ROOT.'/views/layouts/header.php';?>
		<H1> "<? echo $articleItem['Name']; ?>"</H1>
		<div class="articleView">
		<?
			for($i = 0; $i<count($articleItem['Text']); $i++){
				echo $articleItem['Text'][$i];
				if ($articleItem['image_file'][$i] !== NULL){
					echo "<div class='image'>";
					echo '<img src ="/'.FOLDER_NAME.'static/images/'.$articleItem['image_file'][$i].'">';
					echo "</div>";
				}
			}
		?>
		</div>
	</BODY>
</HTML>