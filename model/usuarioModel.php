<?php 
/**
* Clase Usuario
*/
class Usuario extends baseModel
{	
	public $id;
	public $nombre;
	public $apellido;
	public $usuario;
	public $clave;
	public $privilegio;
	public $estado;

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{

		$pdoa = new PDOadm;
		$select = array('usuario', 'clave', 'id', 'nombre', 'apellido', 'privilegio', 'estado');
		$from = 'fwusuario';
		$user = $this->usuario;		
		$pass = $this->clave;			
		$r = $pdoa->ADMLogin($select, $from, $user, $pass);
		if ($r) 
		{
			return helperView::redirect('intranet/index');
		}
		else
		{
			return 'datos erroneos';
		}
	}
}

 ?>