<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['designation' => 'Biscuit', 'prix' => 1000, 'quantite_stock' => 50],
            ['designation' => 'Pain',    'prix' => 400,  'quantite_stock' => 30],
            ['designation' => 'Lait',    'prix' => 800,  'quantite_stock' => 40],
            ['designation' => 'Sucre',   'prix' => 600,  'quantite_stock' => 60],
            ['designation' => 'Huile',   'prix' => 1500, 'quantite_stock' => 25],
        ];
        $this->db->table('produit')->insertBatch($data);
    }
}