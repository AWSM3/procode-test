<?php
/**
 * @filename: AdapterInterface.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Database;

/**
 * Interface AdapterInterface
 * @package App\Core\Database
 */
interface AdapterInterface
{
    /**
     * @param string $sql SQL
     * @param array  $parameters
     *
     * @return \PDOStatement
     */
    public function query($sql, array $parameters = []): \PDOStatement;

    /**
     * @param       $sql
     * @param array $parameters
     *
     * @return mixed
     */
    public function fetchRow($sql, array $parameters = []);

    /**
     * @param       $sql
     * @param array $parameters
     *
     * @return array
     */
    public function fetchAll($sql, array $parameters = []): array;

    /**
     * @param $sql
     *
     * @return int
     */
    public function execute($sql): int;

    /**
     * @return void
     */
    public function beginTransaction(): void;

    public function commitTransaction(): void;

    /**
     * @return void
     */
    public function rollbackTransaction(): void;

    /**
     * @param \PDOStatement $statement
     *
     * @return bool
     */
    public function statementHasError(\PDOStatement $statement): bool;
}