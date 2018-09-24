<?php
/**
 * @filename: PdfHtmlConverterFactory.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager\Converter\Factory;

/** @uses */
use App\Core\DI\InvokableFactoryInterface;
use App\Manager\Converter\PdfHtmlConverter;
use Interop\Container\ContainerInterface;

/**
 * Class PdfHtmlConverterFactory
 * @package App\Manager\Converter\Factory
 */
class PdfHtmlConverterFactory implements InvokableFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        return new PdfHtmlConverter;
    }
}