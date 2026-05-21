<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Infraestructure;

use Doctrine\DBAL\Connection;
use SocialNews\FrontPage\Application\Submission;
use SocialNews\FrontPage\Application\SubmissionsQuery;

final class DbalSubmissionsQuery implements SubmissionsQuery
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /* public function execute(): array
    {
        $rows = $this->connection->fetchAllAssociative('SELECT title, url FROM submissions');
        return array_map(function (array $row) {
            return new Submission($row['title'], $row['url']);
        }, $rows);
    } */

    public function execute(): array
    {
        $qb = $this->connection->createQueryBuilder();

        $qb->addSelect('title', 'url')
            ->from('submissions')
            ->orderBy('creation_date', 'DESC');

        $stmt = $qb->executeQuery();
        $rows = $stmt->fetchAllAssociative(); 

        $submissions = [];
        foreach ($rows as $row) {
            $submissions[] = new Submission($row['title'], $row['url']);
        }

        return $submissions;
    } 
}