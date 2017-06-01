<?php
/**
* Controlador del layout controllerLayout
*/
class loginController extends baseController
{                         
	//public $layout = 'layout/loginLayout';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	

		//Filtrado datos de entrada
		$rules = array(
			'sucursal' => array(
				array("required" => true, 'msg' => ''),
				array("alpha" => true, 'msg' => ''),
				),
			'usuario' => array(
				array("required" => true, 'msg' => ''),
				),
			'password' => array(
				array("required" => true, 'msg' => ''),
				),
			);

		$msg = null;

		if (isset($_POST['token'])) 
		{
			$validate = new formValidate();
			$validate->validate($rules);
			if (!$validate->isValid) 
			{
			$msg = 'Campos sin llenar o no válidos. Envíe nuevamente el formulario.';
				array_push($this->validation, false);
			}
			else
			{
				array_push($this->validation, true);
			}
		}	

		//protección csrf

		if (isset($_POST['token']) and securePHP::csrf(3) != true) 
		{
			$msg = 'acceso denegado';
			array_push($this->validation, false);	
		}
		else
		{
			array_push($this->validation, true);
		}
			
		//procesamiento de datos
		
		
		return helperView::showLayout(null, array('msg' => $msg));			
		
	}

}