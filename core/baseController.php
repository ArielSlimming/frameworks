<?php  

abstract class baseController
{	
	public $layout = 'view/layout/loginLayout.php';
	public $validation = array();

	public function __construct()
	{
		include_once 'core/resources/formValidate.php';
	}

	public function __call($method, $arguments)
	{
		echo 'metodo inexistente';
	}

	public function callAction($action)
	{		
		if (is_callable(array($this, $action))) 
		{
			return call_user_func(array($this, $action));
		}
		else
		{
			echo "Método no encontrado";
		}
	}
}