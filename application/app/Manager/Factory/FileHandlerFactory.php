<?php
/**
 * @filename: FileHandlerFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager\Factory;

/** @uses */
use App\Core\Database\AdapterInterface;
use App\Core\DI\InvokableFactoryInterface;
use App\Core\Storage\StorageInterface;
use App\Entity\Mappers\FileMapper;
use App\Entity\Mappers\FilePageMapper;
use App\Manager\Converter\ConverterInterface;
use App\Manager\FileHandler;
use App\Repository\Interfaces\FilePageRepositoryInterface;
use App\Repository\Interfaces\FileRepositoryInterface;
use Interop\Container\ContainerInterface;

/**
 * Class FileHandlerFactory
 * @package App\Manager\Factory
 */
class FileHandlerFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        return new FileHandler(
            $container->get(ConverterInterface::class),
            $container->get(StorageInterface::class),
            $container->get(FileRepositoryInterface::class),
            $container->get(FilePageRepositoryInterface::class),
            $container->get(FileMapper::class),
            $container->get(FilePageMapper::class),
            $container->get(AdapterInterface::class)
        );
    }
}