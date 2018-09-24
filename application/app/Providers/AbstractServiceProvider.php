<?php
/**
 * @filename: AbstractServiceProvider.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Providers;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use Interop\Container\ContainerInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class AbstractServiceProvider
 * @package App\Providers
 */
abstract class AbstractServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Container $container)
    {
        foreach ($this->factories() as $interface => $factory) {
            $container[$interface] = $factory;
        }
    }

    /**
     * @return array
     */
    abstract protected function factories(): array;

    /**
     * @param InvokableFactoryInterface $factory
     *
     * @return \Closure
     */
    protected function invokableFactory(InvokableFactoryInterface $factory): \Closure
    {
        return function (ContainerInterface $container) use ($factory) {
            return $factory($container);
        };
    }
}