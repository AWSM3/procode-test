<?php
/**
 * @filename: EntryActionFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Http\Action\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Core\View\Engine\RendererInterface;
use App\Http\Action\EntryAction;
use App\Repository\Interfaces\FilePageRepositoryInterface;
use Interop\Container\ContainerInterface;

/**
 * Class EntryActionFactory
 * @package App\Http\Action\Factory
 */
class EntryActionFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        return new EntryAction(
            $container->get(RendererInterface::class),
            $container->get(FilePageRepositoryInterface::class)
        );
    }
}