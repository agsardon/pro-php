<?php declare(strict_types=1);

$routes = function(FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/', 'SocialNews\FrontPage\Presentation\FrontPageController@show');
    $r->addRoute('GET', '/submit', ['SocialNews\Submission\Presentation\SubmissionController', 'show']);
    
};

return $routes;