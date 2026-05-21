<?php declare(strict_types=1);

use Migrations\Migration202605201058;

require __DIR__ . '/../vendor/autoload.php';

define('ROOT_DIR', dirname(__DIR__));

$dependencies = require __DIR__ . '/../src/Dependencies.php';

$connection = $dependencies->get(\Doctrine\DBAL\Connection::class);

/* $params = $connection->getParams();

var_dump($params);

var_dump(
    ROOT_DIR . '/storage/db.sqlite3'
); */

$migration = new Migration202605201058($connection);
$migration->migrate();

echo "Migration completed successfully." . PHP_EOL;

/* var_dump(
    file_exists(ROOT_DIR . '/storage/db.sqlite3')
); */
