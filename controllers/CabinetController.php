<?php

include_once ROOT.'/models/User.php';

class CabinetController
{
	public function action()
	{
		$userLogin = User::checkLogged();
		
		$user = User::getUserByLogin($userLogin);
		
		require_once(ROOT.'/views/cabinet/Cabinet_view.php');
		return true;
	}
}