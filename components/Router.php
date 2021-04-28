<?php

class Router
{
	private $routes;	// массив доступных маршрутов сайта
	
	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include_once ''.$routesPath;
	}
	
	// возвращает строку URI-запроса
	private function getURI()
	{
			if (!empty($_SERVER['REQUEST_URI'])){
			return trim($_SERVER['REQUEST_URI'], '/'); 
		}
	}
	
	// метод вызывает выбранный контроллер 
	public function run()
	{	
		// получение строки запроса
		$uri = $this->getURI();
		$uri_arr = explode('/', $uri);
		if ($uri_arr !== false) {
            $flag = false;
			if($uri_arr[0]!=='' and $uri_arr[0]!=='article' and $uri_arr[0]!=='registration'
			and $uri_arr[0]!=='cabinet' and $uri_arr[0]!=='users'){
				foreach ($uri_arr as $key=>$item) {
					if (($item === 'article' or $item === 'registration' or $item === 'cabinet'
					or $item === 'users') and $key > 0) {
						$root = '';
						for($i = 0; $i<$key; $i++){
							$root .= $uri_arr[$i].'/';
						}
						define('FOLDER_NAME', $root);
						$flag = true;
					}
					elseif($key === count($uri_arr)-1){
						$root = '';
						for($i= 0; $i<$key+1; $i++){
							$root .= $uri_arr[$i].'/';						
						}
						define('FOLDER_NAME', $root);
						$flag = true;
					}
				}
			}
            if (!$flag) {
                define('FOLDER_NAME', '');
            }
        }
		
		$uri = str_replace(trim(FOLDER_NAME, '/'), '', $uri);
		
		// провекра существования маршрута
		foreach ($this->routes as $uriPattern => $path){

			if (preg_match("~$uriPattern~", $uri)){				
				if ($uriPattern !== '') {
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                }
                else {					
					if ($uri === ""){
						$internalRoute = $path;
					}
                }				
				
				$matches = array();
                preg_match('@(article/?.*$|cabinet/?$|main/?$|users/?.*$)@', $internalRoute, $matches);
				
                $internalRoute = $matches[0];		
				$segments = explode('/', $internalRoute);
				
				$controllerName = ucfirst($segments[0].'Controller');
				if (isset($segments[1])){				
					$actionName = 'action'.explode('?', ucfirst($segments[1]))[0];
				}
				else $actionName = 'action';
								
				$parameters = array();
				
                for ($i = 2; $i < count($segments); $i++) {
                    $parameters[$i - 2] = $segments[$i];
                }
                $file = ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($file)) {
                    include_once ''.$file;
                }
                
				// создание нужного объекта и вызов нужного метода
                try {
                    $controllerObject = new $controllerName;
                    $is_done = call_user_func_array(array($controllerObject, $actionName), $parameters);
                }
                catch (TypeError $e) {
                    header("HTTP/1.0 404 Not Found");
                    $is_done = false;
                }
                if ($is_done) break;
			}
		}
	}
}