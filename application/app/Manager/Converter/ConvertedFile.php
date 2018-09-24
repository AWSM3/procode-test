<?php
/**
 * @filename: ConvertedFile.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager\Converter;

/**
 * Class ConvertedFile
 * @package App\Manager\Converter
 */
class ConvertedFile
{
    /** @var array */
    private $pages;

    /**
     * ConvertedFile constructor.
     *
     * @param array $pages
     */
    public function __construct(array $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return array
     */
    public function getPages(): array
    {
        return $this->pages;
    }
}