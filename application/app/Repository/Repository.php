<?php
/**
 * @filename: Repository.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Repository;

/** @uses */
use App\Core\Database\AdapterInterface;
use App\Core\Support\Collection;
use App\Core\Support\Paginator;
use App\Entity\EntityInterface;
use App\Entity\Mappers\MapperInterface;
use App\Repository\Interfaces\RepositoryInterface;

/**
 * Class Repository
 * @package App\Repository
 */
abstract class Repository implements RepositoryInterface
{
    /** @var AdapterInterface */
    protected $adapter;
    /** @var MapperInterface */
    protected $mapper;
    /** @var string */
    protected $table;

    /** @var Collection */
    private $inMemory;

    /**
     * Repository constructor.
     *
     * @param AdapterInterface $adapter
     * @param MapperInterface  $mapper
     * @param string           $table
     */
    public function __construct(AdapterInterface $adapter, MapperInterface $mapper, string $table)
    {
        $this->adapter = $adapter;
        $this->mapper = $mapper;
        $this->table = $table;
        $this->inMemory = new Collection;
    }


    /**
     * @param array $items
     *
     * @return Collection
     */
    protected function hydrateMany(array $items): Collection
    {
        $hydrated = array_map(function ($item) {
            return $this->hydrate($item);
        }, $items);

        return new Collection($hydrated);
    }

    /**
     * @param array $item
     *
     * @return EntityInterface
     */
    protected function hydrate(array $item): EntityInterface
    {
        return $this->mapper->hydrate($item);
    }

    /**
     * @param array $columns
     *
     * @return Collection
     */
    public function getAll(array $columns = ['*']): Collection
    {
        $columns = $this->columns($columns);
        $items = $this->adapter->fetchAll(
            sprintf("SELECT %s FROM %s",
                $columns,
                $this->table
            )
        );

        return $this->hydrateMany($items);
    }

    /**
     * @param        $id
     * @param string $column
     * @param array  $columns
     *
     * @return EntityInterface
     */
    public function get($id, string $column = self::ID_COLUMN, array $columns = ['*']): EntityInterface
    {
        $columns = $this->columns($columns);
        if (!$this->hasInMemory($id)) {
            $item = $this->adapter->fetchRow(
                sprintf('SELECT %s FROM %s WHERE %s = :id', $columns, $this->table, $column),
                ['id' => $id]
            );
            if (!$item) {
                throw new Exception\ItemNotFoundException;
            }
            $hydrated = $this->hydrate($item);
            $this->storeToMemory($id, $hydrated);

            return $hydrated;
        } else {
            return $this->getFromMemory($id);
        }
    }

    /**
     * @param int   $perPage
     * @param int   $page
     * @param array $columns
     *
     * @return Paginator
     */
    public function paginateAll(int $perPage, int $page = 1, array $columns = ['*']): Paginator
    {
        $page = $page === 0 ? 1 : $page;
        $columns = $this->columns($columns);
        $offset = --$page*$perPage;
        $items = $this->adapter->fetchAll(
            sprintf("SELECT %s FROM %s LIMIT %u,%u",
                $columns,
                $this->table,
                $offset,
                $perPage
            )
        );

        return new Paginator(
            $this->hydrateMany($items),
            $this->countAll(),
            $page,
            $perPage
        );
    }

    /**
     * @return int
     */
    public function countAll(): int
    {
        $item = $this->adapter->fetchRow(sprintf("SELECT COUNT(*) AS count FROM %s", $this->table));

        return (int)$item['count'];
    }

    /**
     * @param array $columns
     *
     * @return string
     */
    protected function columns(array $columns): string
    {
        $temp = [];
        foreach ($columns as $key => $value) {
            if (is_string($key)) {
                $temp[] = sprintf('%s AS %s', $key, $value);
            } else {
                $temp[] = $value;
            }
        }

        return implode(',', $temp);

    }

    /**
     * @param $id
     *
     * @return bool
     */
    protected function hasInMemory($id): bool
    {
        return $this->inMemory->hasKey($id);
    }

    /**
     * @param $id
     * @param $item
     *
     * @return void
     */
    protected function storeToMemory($id, $item): void
    {
        $this->inMemory->set($id, $item);
    }

    /**
     * @param $id
     *
     * @return null
     */
    protected function getFromMemory($id)
    {
        return $this->inMemory->get($id);
    }
}