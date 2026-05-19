<?php declare(strict_types=1);

namespace SocialNews\Framework\Rendering;

final class TwigtemplateRendererFactory
{
    private TemplateDirectory $templateDirectory;

    public function __construct(TemplateDirectory $templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
    }

    public function create(): TemplateRenderer
    {
        $templateDirectory = $this->templateDirectory->toString();
        $loader = new \Twig\Loader\FilesystemLoader($templateDirectory);
        $twig = new \Twig\Environment($loader);

        return new TwigTemplateRenderer($twig);
    }
}