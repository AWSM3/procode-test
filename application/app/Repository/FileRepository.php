<?php
/**
 * @filename: FileRepository.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Repository;

/** @uses */
use App\Entity\EntityInterface;
use App\Entity\File;

/**
 * Class FileRepository
 * @package App\Repository
 */
class FileRepository extends Repository implements Interfaces\FileRepositoryInterface
{
    /**
     * @param File|EntityInterface $entity
     *
     * @return void
     */
    public function create(EntityInterface $entity): void
    {
        $data = $this->mapper->extract($entity);
        $statement = $this->adapter->query(
            sprintf("INSERT INTO %s (id, hash, stored_file) VALUES (?, ?, ?)", $this->table),
            [$data['id'], $data['hash'], $data['stored_file']]
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
            $values = array_merge($values, [$data['id'], $data['hash'], $data['stored_file']]);
        }

        $statement = $this->adapter->query(
            sprintf("INSERT INTO %s (id hash, stored_file) VALUES %s",
                $this->table,
                implode(',', array_fill(0, count($entities), '(?,?,?)'))
            ),
            $values
        );

        if ($this->adapter->statementHasError($statement)) {
            throw new Exception\ErrorWhileSavingEntityException;
        }
    }
}