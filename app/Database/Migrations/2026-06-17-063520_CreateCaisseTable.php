<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCaisseTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'      => ['type' => 'INTEGER', 'auto_increment' => true],
            'numero'  => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false, 'unique' => true],
            'libelle' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('caisse');
    }

    public function down()
    {
        $this->forge->dropTable('caisse');
    }
}