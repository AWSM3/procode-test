<?php
/**
 * @filename: Collection.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Support;

/**
 * Class Collection
 * @todo    Лучше, конечно, заюзать готовое и более фунциональное решение типа illuminate/support
 *
 * @package App\Core\Support
 */
class Collection
{
    /** @var array */
    protected $items;

    /**
     * Collection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * @param \Closure $closure
     *
     * @return $this
     */
    public function map(\Closure $closure): Collection
    {
        return new self(array_map($closure, $this->items));
    }

    /**
     * @param $item
     *
     * @return $this
     */
    public function push($item): Collection
    {
        $this->items[$item] = $item;

        return $this;
    }

    /**
     * @param string $key
     * @param        $value
     *
     * @return $this
     */
    public function set(string $key, $value): Collection
    {
        $this->items[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->hasKey($key) ? $this->items[$key] : null;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasKey($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return array_pop(array_reverse($this->items));
    }
}