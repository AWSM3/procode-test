<?php
/**
 * @filename: FilePageMapperFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Entity\Mappers\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Entity\Mappers\FilePageMapper;
use App\Repository\Interfaces\FileRepositoryInterface;
use Interop\Container\ContainerInterface;

/**
 * Class FilePageMapperFactory
 * @package App\Entity\Mappers\Factory
 */
class FilePageMapperFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        return new FilePageMapper(
            $container->get(FileRepositoryInterface::class)
        );
    }
}