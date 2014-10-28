<?php

use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    $table = $this->table('statuses', 
        [
            'id' => false, 
            'primary_key' => ['id']
        ]);
    $table->addColumn('id', 'char', ['limit' => 36])
            ->addColumn('name', 'char', ['limit' => 255])
            ->addColumn('model', 'string', ['limit' => 128])
            ->create();;
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}