<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use SocialNews\Framework\Rendering\TemplateRenderer;
use SocialNews\Framework\Rendering\TwigTemplateRendererFactory;

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAttributes(false);

$builder->addDefinitions([
    TemplateRenderer::class => \DI\factory(function (ContainerInterface $c) {
        $factory = $c->get(TwigTemplateRendererFactory::class);
        return $factory->create();
    }),
]);

$container = $builder->build();

return $container;
