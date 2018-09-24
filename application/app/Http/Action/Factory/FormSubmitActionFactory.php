<?php
/**
 * @filename: FormSubmitActionFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Http\Action\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Core\Routing\RouterInterface;
use App\Http\Action\FormSubmitAction;
use App\Manager\FileHandler;
use Interop\Container\ContainerInterface;

/**
 * Class FormSubmitActionFactory
 * @package App\Http\Action\Factory
 */
class FormSubmitActionFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        return new FormSubmitAction(
            $container->get(FileHandler::class),
            $container->get(RouterInterface::class)
        );
    }
}