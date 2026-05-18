<?php declare(strict_types=1);

define('ROOT_DIR', dirname(__DIR__));

require ROOT_DIR . '/vendor/autoload.php';

\Tracy\Debugger::enable();

$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

$dispatcher = FastRoute\simpleDispatcher(require ROOT_DIR . '/src/routes.php');

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $response = new Symfony\Component\HttpFoundation\Response('Not found', 404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response = new Symfony\Component\HttpFoundation\Response('Method not allowed', 405);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        
        if (is_array($handler)) {
            [$controllerName, $method] = $handler;
        } else {
            [$controllerName, $method] = explode('@', $handler);
        }

        $container = include 'dependencies.php';
        $controller = $container->get($controllerName);

        $response = $controller->$method($request, $vars);
        break;
}

if (! $response instanceof Symfony\Component\HttpFoundation\Response) {
    throw new \LogicException('Controller methodsmust return an Response object');
}

$response->prepare($request);

$response->send();

