<?php 

/**
* 
*/
class baseModel extends DBConect
{	
	private $con;

	public function __construct()
	{
		$this->con=parent::conectar();
		parent::charset();
		require_once 'core/resources/PDOadm.php';
    }
	
}