<?php 
/**
* 
*/
class securePHP
{
	static function csrf($mode = 1) //seguridad contra ataques csrf
	{
		if ($mode == 1) //crea token de eseguridad en una variable de sesin
		{	
			if (!isset($_SESSION)) 
			{	
				session_start();
			}

			$token = md5(uniqid(rand(), true));
			return $token;
		}
		elseif($mode == 2) //copia el token creado en un input text
		{
			echo "<input style='' type='text' name='token' value='".$_SESSION['token']."'>";
		}
		elseif ($mode == 3) //comprueba que ambos tokens existan y coincidan.
		{
			if (isset($_SESSION['token']) and isset($_POST['token']) and $_POST['token'] == $_SESSION['token']) 
			{
				return true;				
			}
			else
			{
				return false;
			}
		}

	}	
}

 ?>