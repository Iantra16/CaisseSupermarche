<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table      = 'produit';
    protected $primaryKey = 'id';
    protected $allowedFields = ['designation', 'prix', 'quantite_stock'];
    protected $useTimestamps = false;

    public function getAll() {
        return $this->findAll();
    }

    public function findById($id) {
        return $this->where('id', $id)->first();
    }
}