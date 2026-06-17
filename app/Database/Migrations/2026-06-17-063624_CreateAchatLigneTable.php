<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAchatLigneTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INTEGER', 'auto_increment' => true],
            'achat_id'      => ['type' => 'INTEGER', 'null' => false],
            'produit_id'    => ['type' => 'INTEGER', 'null' => false],
            'quantite'      => ['type' => 'INTEGER', 'null' => false],
            'prix_unitaire' => ['type' => 'REAL', 'null' => false],
            'montant'       => ['type' => 'REAL', 'null' => false],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('achat_id', 'achat', 'id');
        $this->forge->addForeignKey('produit_id', 'produit', 'id');
        $this->forge->createTable('achat_ligne');
    }

    public function down()
    {
        $this->forge->dropTable('achat_ligne');
    }
}