<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use SocialNews\Framework\Rendering\TemplateDirectory;
use SocialNews\Framework\Rendering\TemplateRenderer;
use SocialNews\Framework\Rendering\TwigTemplateRendererFactory;
use SocialNews\FrontPage\Application\SubmissionsQuery;

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAttributes(false);

$builder->addDefinitions([
    TemplateRenderer::class => \DI\factory(function (ContainerInterface $c) {
        $factory = $c->get(TwigTemplateRendererFactory::class);
        return $factory->create();
    }),
    TemplateDirectory::class => \DI\factory(function () {
        return new TemplateDirectory(ROOT_DIR);
    }),
    SubmissionsQuery::class => \DI\factory(function () {
        return new \SocialNews\FrontPage\Infraestructure\MockSubmissionQuery();
    }),
]);

$container = $builder->build();

return $container;
