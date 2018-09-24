<?php
/**
 * @filename: RepositoryInterface.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Repository\Interfaces;

/** @uses */
use App\Core\Support\Collection;
use App\Core\Support\Paginator;
use App\Entity\EntityInterface;

/**
 * Interface RepositoryInterface
 * @package App\Repository\Interfaces
 */
interface RepositoryInterface
{
    const
        ID_COLUMN = 'id';

    /**
     * @param array $columns
     *
     * @return Collection
     */
    public function getAll(array $columns = ['*']): Collection;

    /**
     * @param        $id
     * @param string $column
     * @param array  $columns
     *
     * @return EntityInterface
     */
    public function get($id, string $column = self::ID_COLUMN, array $columns = ['*']): EntityInterface;

    /**
     * @param EntityInterface $entity
     *
     * @return void
     */
    public function create(EntityInterface $entity): void;

    /**
     * @param EntityInterface ...$entities
     *
     * @return void
     */
    public function createMany(EntityInterface ...$entities): void;

    /**
     * @param int   $perPage
     * @param int   $page
     * @param array $columns
     *
     * @return Paginator
     */
    public function paginateAll(int $perPage, int $page = 1, array $columns = ['*']): Paginator;

    /**
     * @return int
     */
    public function countAll(): int;
}