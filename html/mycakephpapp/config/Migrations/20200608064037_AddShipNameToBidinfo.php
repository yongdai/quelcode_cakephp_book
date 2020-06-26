<?php
use Migrations\AbstractMigration;

class AddShipNameToBidinfo extends AbstractMigration
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
        $table->addColumn('ship_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }
    public function down()
    {
        $table = $this->table('bidinfo');
        $table->removeColumn('ship_name');
        $table->update();
    }
}