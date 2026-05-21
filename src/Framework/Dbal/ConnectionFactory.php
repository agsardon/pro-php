<?php declare(strict_types=1);

namespace SocialNews\Framework\Dbal;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;

final class ConnectionFactory
{
    private DatabaseUrl $databaseUrl;

    public function __construct(DatabaseUrl $databaseUrl)
    {
        $this->databaseUrl = $databaseUrl;
    }

    public function create(): Connection
    {
        $config = new Configuration();
        return DriverManager::getConnection([
            'path' => $this->databaseUrl->toString(),
            'driver' => 'pdo_sqlite',
        ], $config);
    } 
}