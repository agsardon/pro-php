<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Infraestructure;

use SocialNews\FrontPage\Application\Submission;
use SocialNews\FrontPage\Application\SubmissionsQuery;

final class MockSubmissionQuery implements SubmissionsQuery
{
    private array $submissions;
    
    public function __construct()
    {
        $this->submissions = [
            new Submission('DuckDuckGo', 'http://duckduckgo.com'),
            new Submission('Google', 'http://google.com'),
            new Submission('Bing', 'http://bing.com'),
        ];
    }
    public function execute(): array
    {
        return $this->submissions;
    }
}