<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAchatTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'auto_increment' => true],
            'caisse_id'  => ['type' => 'INTEGER', 'null' => false],
            'date_achat' => ['type' => 'DATETIME', 'null' => true],
            'statut'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'default' => 'en_cours'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('caisse_id', 'caisse', 'id');
        $this->forge->createTable('achat');
    }

    public function down()
    {
        $this->forge->dropTable('achat');
    }
}