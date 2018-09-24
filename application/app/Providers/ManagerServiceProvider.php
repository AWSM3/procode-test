<?php
/**
 * @filename: ManagerServiceProvider.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Providers;

/** @uses */
use App\Core\Storage\StorageInterface;
use App\Manager\Converter\ConverterInterface;
use App\Manager\Converter\Factory\PdfHtmlConverterFactory;
use App\Manager\FileHandler;
use App\Manager\Factory\FileHandlerFactory;
use App\Manager\Storage\Factory\LocalStorageFactory;

/**
 * Class ManagerServiceProvider
 * @package App\Providers
 */
class ManagerServiceProvider extends AbstractServiceProvider
{
    /**
     * @return array
     */
    protected function factories(): array
    {
        return [
            FileHandler::class        => $this->invokableFactory(new FileHandlerFactory),
            ConverterInterface::class => $this->invokableFactory(new PdfHtmlConverterFactory),
            StorageInterface::class   => $this->invokableFactory(new LocalStorageFactory)
        ];
    }
}