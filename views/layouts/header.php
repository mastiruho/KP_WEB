<!DOCTYPE HTML>

<HTML>
	<HEAD>
	<meta charset = "utf-8">
		<TITLE>		
			Учебный портал
		</TITLE>
		<script src="/<?echo FOLDER_NAME; ?>static/js/Window.js"></script>
		<link rel="stylesheet" href="/<?echo FOLDER_NAME; ?>static/css/styles.css">
	</HEAD>
	<BODY>
	<header>
		<? include_once ROOT.'/models/User.php'; if (User::isGuest()): ?>		
			<div class="logoutLeft"><a href="/<?echo FOLDER_NAME; ?>" class="header">Главная страница</a></div>	
			<div class="logoutRight"><a href="/<?echo FOLDER_NAME; ?>users/login/" class="header">Вход на сайт</a></div>
		<? else: ?>
			<div class="loginLeft"><a href="/<?echo FOLDER_NAME; ?>" class="header">Главная страница</a></div>
			<div class="loginLeft"><a href="/<?echo FOLDER_NAME; ?>article/" class="header">Статьи</a></div>
			<div class="loginRight"><a href="/<?echo FOLDER_NAME; ?>cabinet/" class="header">Личный кабинет</a></div>
			<div class="loginRight"><a href="#" onclick="confirmWindow2('<?echo FOLDER_NAME; ?>')" class="header">Выход с сайта</a></div>
		<? endif; ?>		
	</header>