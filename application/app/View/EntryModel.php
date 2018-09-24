<?php
/**
 * @filename: EntryModel.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\View;

use App\Core\Support\Collection;
use App\Entity\File;
use App\Entity\FilePage;

/**
 * Class EntryModel
 * @package App\View
 */
class EntryModel
{
    /** @var File */
    protected $file;
    /** @var FilePage[]|Collection */
    protected $pages;

    /**
     * EntryModel constructor.
     *
     * @param File                  $file
     * @param Collection|FilePage[] $pages
     */
    public function __construct(File $file, Collection $pages)
    {
        $this->file = $file;
        $this->pages = $pages;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @return Collection|FilePage[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }
}