<?php
/**
 * @filename: FilePageRepository.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Repository;

/** @uses */
use App\Core\Support\Collection;
use App\Entity\EntityInterface;
use App\Entity\FilePage;

/**
 * Class FilePageRepository
 * @package App\Repository
 */
class FilePageRepository extends Repository implements Interfaces\FilePageRepositoryInterface
{
    /**
     * @param FilePage|EntityInterface $entity
     *
     * @return void
     */
    public function create(EntityInterface $entity): void
    {
        $data = $this->mapper->extract($entity);
        $statement = $this->adapter->query(
            sprintf("INSERT INTO %s (id, file, page, content) VALUES (?, ?, ?)", $this->table),
            [$data['id'], $data['file'], $data['page'], $data['content']]
        );

        if ($this->adapter->statementHasError($statement)) {
            throw new Exception\ErrorWhileSavingEntityException;
        }
    }

    /**
     * @param EntityInterface ...$entities
     *
     * @return void
     */
    public function createMany(EntityInterface ...$entities): void
    {
        $values = [];
        foreach ($entities as $entity) {
            $data = $this->mapper->extract($entity);
            $values = array_merge($values, [$data['id'], $data['file'], $data['page'], $data['content']]);
        }

        $statement = $this->adapter->query(
            sprintf(
                "INSERT INTO %s (id, file, page, content) VALUES %s",
                $this->table,
                implode(',', array_fill(0, count($entities), '(?,?,?,?)'))
            ),
            $values
        );

        if ($this->adapter->statementHasError($statement)) {
            throw new Exception\ErrorWhileSavingEntityException;
        }
    }

    /**
     * @param string $file
     *
     * @param array  $columns
     *
     * @return Collection
     */
    public function getByFile(string $file, array $columns = ['*']): Collection
    {
        $columns = $this->columns($columns);
        $items = $this->adapter->fetchAll(
            sprintf(
                "SELECT %s FROM %s WHERE file = ?",
                $columns, $this->table
            ),
            [$file]
        );

        return $this->hydrateMany($items);
    }
}