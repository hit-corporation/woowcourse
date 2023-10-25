<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateMembersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
		$table = $this->table('members');
		$table->addColumn('member_name', 'string', ['limit' => 100])
			  ->addColumn('no_induk', 'string', ['limit' => 100])
			  ->addColumn('kelas', 'string', ['limit' => 50])
			  ->addColumn('card_number', 'string', ['limit' => 100])
			  ->addColumn('email', 'string', ['limit' => 100, 'null' => true])
			  ->addColumn('address', 'text', ['null' => true])
			  ->addColumn('phone', 'string', ['limit' => 100, 'null' => true])
        ->addTimestamps()
			  ->addColumn('deleted_at', 'datetime', ['null' => true])

			  ->addIndex(['no_induk', 'deleted_at'], ['unique' => true])
			  ->create();
    }
}
