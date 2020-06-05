<?php
use Migrations\AbstractMigration;

class AddDescriptionToBiditems extends AbstractMigration
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
        $table = $this->table('biditems');
        $table->addColumn('description', 'string', [
            'default' => null,
            'limit' => 1000,
            'null' => true,
        ]);
        $table->update();
    }

    public function down()
    {
        $table = $this->table('biditems');
        $table->removeColumn('description');
        $table->update();
    }
}
