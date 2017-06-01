<?php 
session_start();
require_once 'core/helperView.php';
require_once 'core/resources/securePHP.php';

foreach(glob("model/*.php") as $file)
{
    require_once $file;
}

if (DEBUG) 
{
	require_once 'resources/errorLog.php';
}
else
{
	error_reporting('E_ALL');
}

if (isset($_GET['r']))
{
	$route = $_GET['r'];
	$route = explode('/', $route);

	$controller = $route[0];
	$action = $route[1];
}
else
{
	$controller = DF_CTR;
	$action = DF_ACT;	
}



$classController = $controller.'Controller'; //almacena en classController el controlador que llega por url

require_once 'controller/'.$classController.'.php'; //lo incluye

$obj = new $classController; //crea un objeto de clase classController

$obj->callAction($action);

//call_user_func(array($obj, $action));

