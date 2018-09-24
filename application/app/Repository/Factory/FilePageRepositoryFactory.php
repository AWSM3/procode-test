<?php
/**
 * @filename: FilePageRepositoryFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Repository\Factory;

/** @uses */
use App\Core\Database\AdapterInterface;
use App\Core\DI\InvokableFactoryInterface;
use App\Entity\Mappers\FilePageMapper;
use App\Repository\FilePageRepository;
use Interop\Container\ContainerInterface;

/**
 * Class FilePageRepositoryFactory
 * @package App\Repository\Factory
 */
class FilePageRepositoryFactory implements InvokableFactoryInterface
{

    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $table = $container->get('settings')['db']['tables']['file_pages'];

        return new FilePageRepository(
            $container->get(AdapterInterface::class),
            $container->get(FilePageMapper::class),
            $table
        );
    }
}