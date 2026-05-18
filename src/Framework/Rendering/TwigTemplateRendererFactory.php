<?php declare(strict_types=1);

namespace SocialNews\Framework\Rendering;

final class TwigtemplateRendererFactory
{
    public static function create(): TemplateRenderer
    {
        $loader = new \Twig\Loader\FilesystemLoader(ROOT_DIR . '/templates');
        $twig = new \Twig\Environment($loader);

        return new TwigTemplateRenderer($twig);
    }
}