<?php
use Migrations\AbstractMigration;

class CreateRatings extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('ratings');
        $table->addColumn('bidinfo_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
        ]);
        $table->addColumn('buyer_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('buyer_rating', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => true,
        ]);
        $table->addColumn('comment_to_buyer', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('buyer_rating_created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('seller_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('seller_rating', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => true,
        ]);
        $table->addColumn('comment_to_seller', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('seller_rating_created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
