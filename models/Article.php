<?php

class Article
{
	// возвращает одну статью по идентификатору $id
	public static function getArticleById($id)
	{
		$id = intval($id);
		
		if ($id){
			$db = Db::getConnection();
			
			$result = array();
			
			$query = $db->prepare('select Name from articles where id =:id');
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_ASSOC);			
			$result = $query->fetch();
			if ($result !== false){
				$query = $db->prepare('select Text, image_file from content where Article_id =:Article_id 
					order by Content_order');
				$query->bindParam(':Article_id', $id, PDO::PARAM_INT);
				$query->execute();	
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$output = $query->fetch();
				$i = 0;
				while ($output !== false){
					$result['Text'][$i] = $output['Text'];
					$result['image_file'][$i] = $output['image_file'];
					$i++;
					$output = $query->fetch();
				}			
			}
			return $result;
		}
	}
	
	// возвращает список статей
	public static function getArticleList()
	{
		$db = Db::getConnection();
		
		$arcicleList = array();
		
		$result = $db->query('select * from Articles');
		
		$i = 0;
		while ($row = $result->fetch()){
			$arcicleList[$i]['id'] = $row['id'];			
			$arcicleList[$i]['Name'] = $row['Name'];
			$i++;
		}
		
		return $arcicleList;
	}
	
	// добалвение статьи
	public static function addArticle($Name, $text, $images)
	{
		$id = 0;
		$db = Db::getConnection();
		
		$sql = 'select id from articles order by id desc limit 1';
		$result = $db->prepare($sql);
		$result->execute();
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result = $result->fetch();
		
		if ($result !== false){
			$id = $result['id'] + 1;
		}
		else $id = 1;
		
		$sql = 'insert into articles values (:id, :Name)';
		
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':Name', $Name, PDO::PARAM_STR);
		$result->execute();
		
		$sql = 'insert into content (Article_id, Content_order, Text, image_file) values 
			(:Article_id, :Content_order, :Text, :image_file)';
		for($i = 0; $i<count($text); $i++){
			if ($i === count($text)-1){
				if ($text[$i] === "") break;
			}
			$result = $db->prepare($sql);
			$result->bindParam(':Article_id', $id, PDO::PARAM_INT);
			$result->bindParam(':Content_order', $i, PDO::PARAM_INT);
			$result->bindParam(':Text', $text[$i], PDO::PARAM_STR);
			if (isset($images["tmp_name"][$i]) and $images['name'][$i]!==""){
				$img_file = $id."_".$i.".jpeg";
				$result->bindParam(':image_file', $img_file, PDO::PARAM_STR);
				move_uploaded_file($images["tmp_name"][$i], ROOT."/static/images/".$img_file);
			}
			else $result->bindValue(':image_file', NULL, PDO::PARAM_INT);
			$result->execute();
		}
		return true;
	}
	
	// обновление статьи
	public static function updateArticle($id, $text)
	{
		$db = Db::getConnection();
		for($i = 0; $i < count($text); $i++){
			$sql = 'update content set Text=:Text where Article_id=:Article_id and Content_order=:Content_order';
			$result = $db->prepare($sql);
			$result->bindParam(':Article_id', $id, PDO::PARAM_INT);
			$result->bindParam(':Content_order', $i, PDO::PARAM_INT);
			$result->bindParam(':Text', $text[$i], PDO::PARAM_STR);
			$result->execute();
		}
		return true;
	}
	
	// удаление статьи
	public static function deleteArticle($id)
	{
		$db = Db::getConnection();
		
		$sql = 'delete from articles where id=:id';
		
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);		
		return $result->execute();
	}
}