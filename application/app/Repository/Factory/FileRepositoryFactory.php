<?php
/**
 * @filename: FileRepositoryFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Repository\Factory;

use App\Core\Database\AdapterInterface;
use App\Core\DI\InvokableFactoryInterface;
use App\Entity\Mappers\FileMapper;
use App\Repository\FileRepository;
use Interop\Container\ContainerInterface;

/** @uses */

/**
 * Class FileRepositoryFactory
 * @package App\Repository\Factory
 */
class FileRepositoryFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $table = $container->get('settings')['db']['tables']['files'];

        return new FileRepository(
            $container->get(AdapterInterface::class),
            $container->get(FileMapper::class),
            $table
        );
    }
}