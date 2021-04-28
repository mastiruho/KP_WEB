<?php

	return array(		
		'article/([0-9]+)' => 'article/view/$1',  			// метод actionView в ArticleController
		'article/add' => 'article/add',						// метод actionAdd в ArticleController	
		'article/update/([0-9]+)' => 'article/update/$1',	// метод actionUpdate в ArticleController	
		'article/delete/([0-9]+)' => 'article/delete/$1',	// метод actionDelete в ArticleController
		'article' => 'article/index',						// метод actionIndex в ArticleController		
		'cabinet' => 'cabinet',								// метод action в CabinetController
		'registration' => 'users',							// метод action в UsersController
		'users/login' => 'users/login',						// метод actionLogin в UsersController
		'users/logout' => 'users/logout',					// метод actionLogout в UsersController
		'' => 'main',										// метод action в MainController
	);