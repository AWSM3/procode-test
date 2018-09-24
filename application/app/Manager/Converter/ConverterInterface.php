<?php
/**
 * @filename: ConverterInterface.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager\Converter;

/**
 * Interface ConverterInterface
 * @package App\Manager\Converter
 */
interface ConverterInterface
{
    /**
     * @param string $filename
     *
     * @return ConvertedFile
     */
    public function convert(string $filename): ConvertedFile;

    /**
     * @param string $filename
     *
     * @return mixed
     */
    public function validateFile(string $filename);
}