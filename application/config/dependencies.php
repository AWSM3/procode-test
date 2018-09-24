<?php
declare(strict_types=1);

/** @uses */
use Interop\Container\ContainerInterface;
use Pimple\Container;
use App\Providers;

/** @var Container|ContainerInterface $container */
$container = $app->getContainer();

/**
 * View renderer
 *
 * @param ContainerInterface $container
 *
 * @return \Slim\Views\PhpRenderer
 */
$container['renderer'] = function (ContainerInterface $container) {
    $settings = $container->get('settings')['renderer'];

    return new Slim\Views\PhpRenderer($settings['template_path']);
};

/**
 * Logger
 *
 * @param ContainerInterface $container
 *
 * @return \Monolog\Logger
 */
$container['logger'] = function (ContainerInterface $container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};


/**
 * Registering service providers
 */
$container->register(new Providers\CoreServiceProvider);
$container->register(new Providers\ActionServiceProvider);
$container->register(new Providers\RepositoryServiceProvider);
$container->register(new Providers\DataMapperServiceProvider);
$container->register(new Providers\ManagerServiceProvider);
