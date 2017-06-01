<?php  

/**
* 
*/
class helperUrl 
{	
	static function url()
	{
		if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] != 'off') 
		{
			$protocol = 'https';
		}
		else
		{
			$protocol = 'http';
		}

		$serverName = $_SERVER['SERVER_NAME'];
		$requestUri = $_SERVER['REQUEST_URI'];

		$path = explode('/', $requestUri);
		array_pop($path);
		array_pop($path);
		$path = implode('/', $path);
		return $protocol.'://'.$serverName.$path;
	}
}