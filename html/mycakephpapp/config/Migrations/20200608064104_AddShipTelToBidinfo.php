<?php
use Migrations\AbstractMigration;

class AddShipTelToBidinfo extends AbstractMigration
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
        $table->addColumn('ship_tel', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->update();
    }
    public function down()
    {
        $table = $this->table('bidinfo');
        $table->removeColumn('ship_tel');
        $table->update();
    }
}