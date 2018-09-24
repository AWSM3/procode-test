<?php
/**
 * @filename: FileMapperFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Entity\Mappers\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Entity\Mappers\FileMapper;
use Interop\Container\ContainerInterface;

/**
 * Class FileMapperFactory
 * @package App\Entity\Mappers\Factory
 */
class FileMapperFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        return new FileMapper;
    }
}