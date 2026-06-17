<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProduitTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INTEGER', 'auto_increment' => true],
            'designation'    => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => false],
            'prix'           => ['type' => 'REAL', 'null' => false],
            'quantite_stock' => ['type' => 'INTEGER', 'null' => false, 'default' => 0],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('produit');
    }

    public function down()
    {
        $this->forge->dropTable('produit');
    }
}