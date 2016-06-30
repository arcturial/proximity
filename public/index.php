<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Application;

$app = new Application;

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/providers.php';
require_once __DIR__ . '/../config/routes.php';


$app->run();
exit(0);