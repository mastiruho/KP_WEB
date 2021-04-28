<? include ROOT.'/views/layouts/header.php';?>	
		<H1>Выберите статью!</H1>
		<table class="articleTable">
		<?foreach ($articleList as $articleItem): ?>
			<tr>
				<td class="nameTd"><a href="/<?echo FOLDER_NAME;?>article/<?echo $articleItem['id'];?>/" class="article"><? echo $articleItem['Name'];?> </a></td>
				<td><a href="/<?echo FOLDER_NAME;?>article/update/<?echo $articleItem['id'];?>/" class="article"> Обновить статью </a></td>
				<td><a href="#" onclick="confirmWindow('<?echo FOLDER_NAME;?>', <?echo $articleItem['id'];?>)" class="article"> Удалить статью</a></td>
			</tr>
		<?endforeach;?>
		<tr>
			<td colspan=3><a href="/<?echo FOLDER_NAME; ?>article/add" class="regAdd">Добавление статьи</a></td>
		</tr>
		</table>
	</BODY>
</HTML>