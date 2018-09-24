<?php
/**
 * @filename: TwigFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\View\Engine\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Core\Routing\RouterInterface;
use Interop\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

/**
 * Class TwigFactory
 * @package App\Core\View\Engine\Factory
 */
class TwigFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $settings = $container->get('settings');
        $view = new Twig(
            $settings['renderer']['template_path'],
            $settings['renderer']['twig']
        );

        $basePath = rtrim(
            str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()),
            '/'
        );
        $view->addExtension(new TwigExtension($container->get(RouterInterface::class), $basePath));

        return $view;
    }
}