<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table      = 'achat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['caisse_id', 'date_achat', 'statut'];
    protected $useTimestamps = false;

    public function getAll()
    {
        return $this->findAll();
    }

    public function findById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getAchatEnCours($caisse_id)
    {
        return $this->where('caisse_id', $caisse_id)
                    ->where('statut', 'en_cours')
                    ->first();
    }

    public function getLignes($achat_id)
    {
        $ligneModel = new AchatLigneModel();
        return $ligneModel->where('achat_id', $achat_id)->findAll();
    }

    public function ajouterLigne($achat_id, $produit_id, $quantite)
    {
        $ligneModel = new AchatLigneModel();
        return $ligneModel->insert([
            'achat_id'   => $achat_id,
            'produit_id' => $produit_id,
            'quantite'   => $quantite,
        ]);
    }
}