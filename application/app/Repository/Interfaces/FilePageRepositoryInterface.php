<?php
/**
 * @filename: FilePageRepositoryInterface.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Repository\Interfaces;

/** @uses */
use App\Core\Support\Collection;

/**
 * Interface FilePageRepositoryInterface
 * @package App\Repository\Interfaces
 */
interface FilePageRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $file
     * @param array  $columns
     *
     * @return Collection
     */
    public function getByFile(string $file, array $columns = ['*']): Collection;
}