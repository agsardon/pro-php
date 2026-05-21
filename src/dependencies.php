<?php declare(strict_types=1);

use Doctrine\DBAL\Connection;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use SocialNews\Framework\Dbal\ConnectionFactory;
use SocialNews\Framework\Dbal\DatabaseUrl;
use SocialNews\Framework\Rendering\TemplateDirectory;
use SocialNews\Framework\Rendering\TemplateRenderer;
use SocialNews\Framework\Rendering\TwigTemplateRendererFactory;

$builder = new ContainerBuilder();

$builder->useAutowiring(true);
$builder->useAttributes(false);

$builder->addDefinitions([

    /*
     |------------------------------------------------------------
     | Template directory
     |------------------------------------------------------------
     */
    TemplateDirectory::class => \DI\factory(function () {
        return new TemplateDirectory(
            ROOT_DIR // raíz del proyecto
        );
    }),

    /*
     |------------------------------------------------------------
     | Template renderer
     |------------------------------------------------------------
     */
    TemplateRenderer::class => \DI\factory(
        function (ContainerInterface $container) {
            return $container
                ->get(TwigTemplateRendererFactory::class)
                ->create();
        }
    ),

    /*
     |------------------------------------------------------------
     | Submissions query
     |------------------------------------------------------------
     */
    SocialNews\FrontPage\Application\SubmissionsQuery::class => \DI\factory(
        function (ContainerInterface $c) {
            return new SocialNews\FrontPage\Infraestructure\DbalSubmissionsQuery(
                $c->get(Connection::class)
            );
        }
    ),

    /*
     |------------------------------------------------------------
     | Database connection
     |------------------------------------------------------------
     */
    DatabaseUrl::class => \DI\factory(function () {
        return new DatabaseUrl(
            ROOT_DIR . '/storage/db.sqlite3'
        );
    }),

    Connection::class => \DI\factory(
        function (ContainerInterface $container) {
            return (new ConnectionFactory(
                $container->get(DatabaseUrl::class),
            ))->create();
        }
    ),

]);

$container = $builder->build();

return $container;
