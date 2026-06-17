<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatLigneModel extends Model
{
    protected $table      = 'achat_ligne';
    protected $primaryKey = 'id';
    protected $allowedFields = ['achat_id', 'produit_id', 'quantite', 'prix_unitaire', 'montant'];
    protected $useTimestamps = false;
}