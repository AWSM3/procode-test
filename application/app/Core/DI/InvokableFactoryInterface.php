<?php
/**
 * @filename: InvokableFactoryInterface.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\DI;

/** @uses */
use Interop\Container\ContainerInterface;

/**
 * Interface InvokableFactoryInterface
 * @package App\Core\DI
 */
interface InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container);
}