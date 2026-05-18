<?php
require __DIR__ . '/../vendor/autoload.php';
$c = include __DIR__ . '/../src/Dependencies.php';
echo is_object($c) ? get_class($c) . PHP_EOL : 'not object' . PHP_EOL;
