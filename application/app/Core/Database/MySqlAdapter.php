<?php
/**
 * @filename: MySqlAdapter.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Database;

/**
 * Class MySqlAdapter
 * @package App\Core\Database
 */
class MySqlAdapter implements AdapterInterface
{
    /** @var \PDO */
    private $pdo;

    /**
     * MySqlAdapter constructor.
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $sql SQL
     * @param array  $parameters
     *
     * @return \PDOStatement
     */
    public function query($sql, array $parameters = []): \PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameters);

        return $statement;
    }

    /**
     * @param       $sql
     * @param array $parameters
     *
     * @return mixed
     */
    public function fetchRow($sql, array $parameters = [])
    {
        $result = $this->query($sql, $parameters);

        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param       $sql
     * @param array $parameters
     *
     * @return array
     */
    public function fetchAll($sql, array $parameters = []): array
    {
        $rows = [];
        $result = $this->query($sql, $parameters);
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * @param $sql
     *
     * @return int
     */
    public function execute($sql): int
    {
        return $this->pdo->exec($sql);
    }

    /**
     * @param \PDOStatement $statement
     *
     * @return bool
     */
    public function statementHasError(\PDOStatement $statement): bool
    {
        return $statement->errorCode() !== '00000';
    }


    /**
     * @return void
     */
    public function beginTransaction(): void
    {
        $this->execute('START TRANSACTION');
    }

    public function commitTransaction(): void
    {
        $this->execute('COMMIT');
    }

    /**
     * @return void
     */
    public function rollbackTransaction(): void
    {
        $this->execute('ROLLBACK');
    }
}