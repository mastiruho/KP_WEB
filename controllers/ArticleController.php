<?php

include_once ROOT.'/models/Article.php';
include_once ROOT.'/models/User.php';

class ArticleController
{
	// метод для получения списка статей
	public function actionIndex()
	{
		User::checkLogged();
		$articleList = array();
		$articleList = Article::getArticleList();		
		require_once(ROOT.'/views/Article/All_Articles.php');
		return true;
	}
	
	// метод для получения конкретной статьи
	public function actionView($id)
	{
		if ($id){
			$articleItem = Article::getArticleById($id);			
			if ($articleItem !== false){
				require_once(ROOT.'/views/Article/Article_view.php');	
			}
			else header("HTTP/1.0 404 Not Found");
		}
		
		return true;
	}
	
	// метод для добавления статьи
	public function actionAdd()
	{
		$flag = false;
		$result = false;
		
		if (isset($_POST['submit'])){
			$Name = $_POST['Name'];
			$text = $_POST['text'];
			
			for ($i = 0; $i < count($text); $i++){
				if ($text[$i] !== ""){
					$flag = true;
					break;
				}
			}
			$images = NULL;
			if (isset($_FILES['images'])){
				$images = $_FILES['images'];
			}
			if ($flag){							
				$result = Article::addArticle($Name, $text, $images);
			}
			if ($result === true) header ("Location: ../article");
		}
		else $flag = true;
		require_once(ROOT.'/views/Article/Article_add.php');
		return true;
	}
	
	// метод для обновления статьи
	public function actionUpdate($id)
	{
		if (isset($_POST['update'])){
			$text = $_POST['text'];
			$result = Article::updateArticle($id, $text);
			if ($result === true) header ("Location: ../../".$id);
		}
		
		if ($id){
			$articleItem = Article::getArticleById($id);	
			require_once(ROOT.'/views/Article/Article_update.php');
		}
		
		return true;
	}
	
	// метод для удаления статьи
	public function actionDelete($id)
	{
		$articleItem = Article::getArticleById($id);
		
		for ($i = 0; $i < count($articleItem['Text']); $i++){
			if (file_exists(ROOT."/static/images/".$articleItem['image_file'][$i])){
				unlink(ROOT."/static/images/".$articleItem['image_file'][$i]);
			}
		}
		$result = Article::deleteArticle($id);
		if ($result === true) header ("Location: ../..");
	}
}