<?php

use Clarity\Support\Phinx\Migration\AbstractMigration;

class TermTaxonomy extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('term_taxonomy', ['id' => 'term_taxonomy_id']);

        $table->addColumn('term_id', 'integer')
            ->addColumn('taxonomy', 'string')
            ->addColumn('description', 'text', ['default' => null ])
            ->addColumn('count', 'integer', ['default' => 0 ] )
            ->addColumn('parent', 'integer' , ['default' => 0 ])
            ->create();

   
    }
}
