<?php
/**
 * @filename: PdfHtmlConverter.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager\Converter;

/** @uses */
use Gufy\PdfToHtml\Pdf;

/**
 * Class PdfHtmlConverter
 * @package App\Manager\Converter
 */
class PdfHtmlConverter implements ConverterInterface
{
    /**
     * @param string $filename
     *
     * @return ConvertedFile
     */
    public function convert(string $filename): ConvertedFile
    {
        $pdf = new Pdf($filename);
        $pages = [];
        $pagesTotal = (int)$pdf->getPages();
        for ($page = 1; $page <= $pagesTotal; $page++) {
            $pages[$page] = $pdf->html($page);
        }

        return new ConvertedFile($pages);
    }
}