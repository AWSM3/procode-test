<?php
/**
 * @filename: DataMapperServiceProvider.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Providers;

/** @uses */
use App\Entity\Mappers\Factory\FileMapperFactory;
use App\Entity\Mappers\Factory\FilePageMapperFactory;
use App\Entity\Mappers\FileMapper;
use App\Entity\Mappers\FilePageMapper;

/**
 * Class DataMapperServiceProvider
 * @package App\Providers
 */
class DataMapperServiceProvider extends AbstractServiceProvider
{
    /**
     * @return array
     */
    protected function factories(): array
    {
        return [
            FileMapper::class     => $this->invokableFactory(new FileMapperFactory),
            FilePageMapper::class => $this->invokableFactory(new FilePageMapperFactory),
        ];
    }
}