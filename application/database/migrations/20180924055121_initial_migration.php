<?php
declare(strict_types=1);

/** @uses */
use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

/**
 * Class InitialMigration
 */
class InitialMigration extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $filesTable = $this->table('files_table', ['id' => false, 'primary_key' => ['id']]);
        $filesTable->addColumn('id', 'string', ['length' => 60])
                   ->addColumn('hash', 'string', ['length' => 255])
                   ->addColumn('stored_file', 'text', ['limit' => MysqlAdapter::TEXT_MEDIUM])
                   ->addIndex(['hash'], ['unique' => true])
                   ->save();

        $filePagesTable = $this->table('file_pages_table', ['id' => false, 'primary_key' => ['id']]);
        $filePagesTable->addColumn('id', 'string', ['length' => 60])
                       ->addColumn('file', 'string', ['length' => 60])
                       ->addColumn('page', 'integer', ['length' => 5])
                       ->addColumn('content', 'text', ['limit' => MysqlAdapter::TEXT_LONG])
                       ->addIndex(['file'])
                       ->addIndex(['file', 'page'], ['unique' => true])
                       ->addForeignKey(
                           'file', 'files_table', 'id',
                           ['delete' => 'CASCADE', 'update' => 'CASCADE']
                       )
                       ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('file_pages_table')->drop()->save();
        $this->table('files_table')->drop()->save();
    }
}
