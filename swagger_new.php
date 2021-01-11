<?php
defined('APP_URL') OR define('APP_URL', ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . "://{$_SERVER['SERVER_NAME']}" . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']));

$api_src = __DIR__.'\application\modules\api\controllers';
$des = __DIR__.'\docs\json';
/*$response = shell_exec('php -r "define(\'APP_URL\', '.APP_URL.');"');
$response = shell_exec('php -r "var_dump(get_defined_constants(true));"');
echo '<pre>';
var_dump($response);
echo '</pre>';
die;*/
try {
	$cmd = 'php docs\php\bin\swagger '.$api_src.' -o '.$des;
	echo $cmd;
	$response = shell_exec($cmd);	
} catch (Exception $e) {
	$error = $e->getMessage();
}


echo '<pre>';
var_dump($response);
// var_dump($error);
echo '</pre>';