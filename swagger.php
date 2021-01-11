<?php
require("vendor/autoload.php");
$dir = __DIR__.'\application\modules\api\controllers';
$openapi = \OpenApi\scan($dir);
header('Content-Type: application/json');
echo $openapi->toJson();