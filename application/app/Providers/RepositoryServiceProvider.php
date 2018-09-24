<?php
/**
 * @filename: RepositoryServiceProvider.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Providers;

/** @uses */
use App\Repository\Factory\FilePageRepositoryFactory;
use App\Repository\Factory\FileRepositoryFactory;
use App\Repository\Interfaces\FilePageRepositoryInterface;
use App\Repository\Interfaces\FileRepositoryInterface;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends AbstractServiceProvider
{
    /**
     * @return array
     */
    protected function factories(): array
    {
        return [
            FilePageRepositoryInterface::class => $this->invokableFactory(new FilePageRepositoryFactory),
            FileRepositoryInterface::class     => $this->invokableFactory(new FileRepositoryFactory),
        ];
    }
}