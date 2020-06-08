<?php
use Migrations\AbstractMigration;

class AddIsShippedToBidinfo extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $table = $this->table('bidinfo');
        $table->addColumn('is_shipped', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
        $table = $this->table('bidinfo');
        $table->removeColumn('is_shipped');
        $table->update();
    }
}