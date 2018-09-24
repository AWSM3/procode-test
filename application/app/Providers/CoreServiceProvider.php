<?php
/**
 * @filename: CoreServiceProvider.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Providers;

/** @uses */
use App\Core\Database\AdapterInterface;
use App\Core\Database\MySqlAdapterFactory;
use App\Core\Routing\RouterInterface;
use App\Core\View\Engine\Factory\TwigFactory;
use App\Core\View\Engine\RendererInterface;
use Interop\Container\ContainerInterface;

/**
 * Class CoreServiceProvider
 * @package App\Providers
 */
class CoreServiceProvider extends AbstractServiceProvider
{
    /**
     * @return array
     */
    final public function factories(): array
    {
        return [
            /** Twig template engine */
            RendererInterface::class => $this->invokableFactory(new TwigFactory),

            /** MySQL Adapter */
            AdapterInterface::class  => $this->invokableFactory(new MySqlAdapterFactory),

            /** Алиас для \Slim\Router */
            RouterInterface::class   => function (ContainerInterface $container) {
                return $container->get('router');
            }
        ];
    }
}