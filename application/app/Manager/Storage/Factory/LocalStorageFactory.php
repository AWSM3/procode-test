<?php
/**
 * @filename: LocalStorageFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager\Storage\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Manager\Storage\LocalStorage;
use Interop\Container\ContainerInterface;

/**
 * Class LocalStorageFactory
 * @package App\Manager\Storage\Factory
 */
class LocalStorageFactory implements InvokableFactoryInterface
{

    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $settings = $container->get('settings');

        return new LocalStorage(
            $settings['storage']['defaultDir'],
            $settings['storage']['public']
        );
    }
}