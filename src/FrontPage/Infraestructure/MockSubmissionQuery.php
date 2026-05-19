<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Infraestructure;

use SocialNews\FrontPage\Application\Submission;
use SocialNews\FrontPage\Application\SubmissionsQuery;

final class MockSubmissionQuery implements SubmissionsQuery
{
    public function execute(): array
    {
        return [
            new Submission('DuckDuckGo', 'http://duckduckgo.com'),
            new Submission('Google', 'http://google.com'),
            new Submission('Bing', 'http://bing.com'),
        ];
    }
}