<?php 

 /**
 * Clase con métodos estáticos con helpers para vistas y procesamiento de urls
 */

 class helperView
 {	
 	static function showLayout($layout = null, $data = null) //incluye la vista y los datos
 	{
 		if (is_array($data)) 
 		{
 			extract($data);
 		}

 		if (isset($_GET['r'])) 
 		{
 			$route = $_GET['r'];
			$route = explode('/', $route);
			$controller = $route[0].'Controller';
 		}
 		else
 		{
			$controller = DF_CTR.'Controller';
 		}
 		
		$obj = new $controller;
		$layout = $obj->layout;

		/*if ($views != null) 
		{
			$nview = 1;
			$arrayviews = null;
			foreach ($views as $view) 
			{
				$view.'n'.$nview = $view;
				array_push($arrayviews, $view.'n'.$nview);
				$nview ++;
			}
			$content = 'view/'.$arrayviews.'View.php';
		}*/

 		include_once $layout; //incluye vista que a la vez muestra el $content
 	}

 	static function url($r, $parameters = null) // recibe un link con el formato controller/action y variables get
 	{

 		$p = null;
 		if (is_array($parameters)) 
 		{
 			foreach($parameters as $param => $value)
 			{
 				$p.= '&'.$param.'='.$value;
 			}
 		}
 		return B_URL.'/index.php?r='.$r.''.$p; 		
 	}

 	static function redirect($r, $parameters = null) //redirecciona a una acción
 	{
		$p = null;
		if (is_array($parameters))
		{
 			foreach($parameters as $param => $value)
 			{
 				$p.= '&'.$param=$value;
 			}
 		}
 		header('Location: index.php?r='.$r.''.$p);
 	}

 	static function loadView($v)
 	{
 		include 'view/'.$v.'View.php';
 	}
 }