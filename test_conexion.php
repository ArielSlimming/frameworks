<?php 
include 'core/helperUrl.php';
include 'config/global.php';
include 'core/DBConect.php';

class prueba extends DBConect
{
	public $con;
	public function __construct()
	{
		$this->con=parent::conectar();
		parent::charset();
		parent::exep();		
	}
}

$obj = new prueba(); 
$sql = "insert into usuario ('id', 'nombre', 'apellido', 'usuario', 'clave', 'privilegio', 'estado') values (null, 'bbb', 'bbb', 'bbb', 'bbb' 1, 1)";

$query = $obj->con->prepare($sql);
print_r($query->errorInfo());


/*$user = 'mario';
$clave = '123';
//$sql = "SELECT usuario, clave, id, nombre, apellido, privilegio, estado FROM fwusuario WHERE usuario = $user AND clave = $clave";
$sql = 'SHOW FULL TABLES FROM framework';
$query = $obj->con->query($sql);
print_r($query->errorInfo())*/
 ?>