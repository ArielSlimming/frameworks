<?php 

define("DF_CTR", "login"); //controlador por defecto
define("DF_ACT", "index"); //acción por defecto

//configuración de constantes para conectar a la base de datos

define('MOTOR', 'mysql');
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'framework');
define('CHARSET', 'utf8'); 

define('B_URL', helperUrl::url()); //URL base

//debugs
define('DEBUG', true);//errores php
define('DEBUGadm', false); //devielve la query en vez del resultado en PDOadm si está en true

//PDOadm
define('tbl', 'table');
define('obj', 'obj');
define('col', 'col');
define('count', 'count');

