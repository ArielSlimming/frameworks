<?php 

abstract class DBConect 
{
	/*private $pdo;
	
	public function conectar()
	{
		$this->pdo = new PDO(MOTOR.':dbname='.DB.';host='.HOST, USER, PASS);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}

	public function charset()
	{
		return $this->pdo->query("SET NAMES 'utf8'");
	}	*/
	private $pdo;

	public function conectar()
	{
		$dsn = MOTOR.':dbname='.DB.';host='.HOST;
		$usuario = USER;
		$pas = PASS;

		try {
		    //$gbd = new PDO($dsn, $usuario, $contraseña);
		    return $this->pdo=new PDO($dsn, $usuario, $pas);

		} catch (PDOException $e) 
			{
		    	echo 'Falló la conexión: ' . $e->getMessage();
			}
	}

	public function charset()
	{
		return $this->pdo->query("SET NAMES 'utf8'");
	}

	public function exep()
	{
		return $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}