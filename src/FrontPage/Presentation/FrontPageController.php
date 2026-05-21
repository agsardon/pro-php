<?php

declare(strict_types=1);

namespace SocialNews\FrontPage\Presentation;

use SocialNews\Framework\Rendering\TemplateRenderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SocialNews\FrontPage\Application\SubmissionsQuery;

final class FrontPageController
{
    private TemplateRenderer $templateRenderer;
    private SubmissionsQuery $submissionsQuery;

    public function __construct(TemplateRenderer $templateRenderer, SubmissionsQuery $submissionQuery)
    {
        $this->templateRenderer = $templateRenderer;
        $this->submissionsQuery = $submissionQuery;
    }

    public function show(Request $request): Response
    {
        $content = $this->templateRenderer->render('front-page.html.twig', [
            'submissions' => $this->submissionsQuery->execute(),
        ]);
        return new Response($content);
    }
}
