<?php
/**
 * @filename: ListActionFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Http\Action\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Core\View\Engine\RendererInterface;
use App\Http\Action\ListAction;
use App\Repository\Interfaces\FileRepositoryInterface;
use Interop\Container\ContainerInterface;

/**
 * Class ListActionFactory
 * @package App\Http\Action\Factory
 */
class ListActionFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ListAction(
            $container->get(RendererInterface::class),
            $container->get(FileRepositoryInterface::class)
        );
    }
}