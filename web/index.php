<?php

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../core/Core.php');

$config = require(__DIR__ . '/../config/main.php');

$app = new core\base\Application($config);
$app->run();

