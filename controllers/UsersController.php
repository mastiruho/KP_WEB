<?php

include_once ROOT.'/models/User.php';

class UsersController
{
	// метод регистрации пользователя
	public function action()
	{	
		$login = '';
		$password = '';
		$result = false;
		
		if (isset($_POST['submit'])){
			$login = $_POST['login'];
			$password = $_POST['password'];
			
			$errors = false;
			
			if(!User::checkLogin($login)){
				$errors[] = 'Логин не короче 4-х символов!';
			}
			if(!User::checkPassword($password)){
				$errors[] = 'Пароль не короче 4-х символов!';
			}
			if(User::checkLoginExist($login)){
				$errors[] = 'Логин уже занят';
			}
			
			if ($errors == false){
				$result = User::register($login, $password);
				header ("Location: ../users/login/");
			}
		}
		require_once(ROOT.'/views/registration/registration.php');
		return true;
	}
	
	// метод осуществляет вход пользователя на сайт
	public function actionLogin(){
		$login = '';
		$password = '';
		
		if (isset($_POST['submit'])){
			$login = $_POST['login'];
			$password = $_POST['password'];
			
			$errors = false;
			
			$userLogin = User::CheckUserData($login, $password);
			
			if ($userLogin == false){
				$errors[] = 'Неправильные данные для входа на сайт!';
			}
			else {
				User::auth($userLogin);
				header ("Location: ../../cabinet/");
			}
		}
		require_once(ROOT.'/views/user/login.php');
		return true;
	}
	
	// метод осуществляет выход пользователя сайта
	public function actionLogout(){			
		unset($_SESSION['user']);
		header ("Location: ../login/");
		return true;
	}
}