<?php

require('bin/lib/init.php');

$params = $_REQUEST;
$params['method'] = $_SERVER['REQUEST_METHOD'];

$controller = isset($params['c']) && !empty($params['c']) ? ucfirst(preg_replace('/[^\w]+/','',$params['c'])).'Controller' : null;
$model = isset($params['c']) && !empty($params['c']) ? ucfirst(preg_replace('/[^\w]+/','',$params['c'])).'Model' : null;
$method = isset($params['m']) && !empty($params['m']) ? $params['m'] : 'index';

unset($params['c'],$params['m']);

if (file_exists("bin/controller/$controller.php") && file_exists("bin/model/$model.php")) 
{
	require("bin/controller/$controller.php");
	require("bin/model/$model.php");
}
else
{
	header('HTTP/1.0 404 Not Found');
	die('404 Not found.');
}

if (isset($controller))
{
	$controller=new $controller($params);
	if (method_exists($controller,$method)) $controller->$method();
	else
	{
		header('HTTP/1.0 404 Not Found');
		die('404 Not found.');
	}
}

?>

