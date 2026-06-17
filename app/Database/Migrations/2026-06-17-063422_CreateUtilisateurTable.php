<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUtilisateurTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => ['type' => 'INTEGER', 'auto_increment' => true],
            'login'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'role'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => false, 'default' => 'caissier'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('utilisateur');
    }

    public function down()
    {
        $this->forge->dropTable('utilisateur');
    }
}