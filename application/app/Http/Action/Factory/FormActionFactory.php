<?php
/**
 * @filename: FormActionFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Http\Action\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Core\View\Engine\RendererInterface;
use App\Http\Action\FormAction;
use Interop\Container\ContainerInterface;

/**
 * Class FormActionFactory
 * @package App\Http\Action\Factory
 */
class FormActionFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        return new FormAction($container->get(RendererInterface::class));
    }
}