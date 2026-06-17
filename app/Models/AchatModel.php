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

    // Retourne l'achat en cours, ou en crée un nouveau
    public function getAchatEnCours($caisseId)
    {
        $achat = $this->where('caisse_id', $caisseId)
                      ->where('statut', 'en_cours')
                      ->first();

        if (!$achat) {
            $id = $this->insert([
                'caisse_id' => $caisseId,
                'statut'    => 'en_cours',
            ]);
            $achat = $this->find($id);
        }

        return $achat;
    }

    // Retourne les lignes d'un achat avec le nom du produit
    public function getLignes($achatId)
    {
        return $this->db->table('achat_ligne al')
            ->select('p.designation, al.prix_unitaire, al.quantite, al.montant')
            ->join('produit p', 'p.id = al.produit_id')
            ->where('al.achat_id', $achatId)
            ->get()
            ->getResultArray();
    }

    // Insère une ligne dans achat_ligne
    public function ajouterLigne($achatId, $produitId, $quantite, $prixUnitaire)
    {
        return $this->db->table('achat_ligne')->insert([
            'achat_id'      => $achatId,
            'produit_id'    => $produitId,
            'quantite'      => $quantite,
            'prix_unitaire' => $prixUnitaire,
            'montant'       => $quantite * $prixUnitaire,
        ]);
    }

    // Clôture un achat
    public function cloturerAchat($achatId)
    {
        return $this->db->table('achat')
            ->where('id', $achatId)
            ->update(['statut' => 'cloture']);
    }
}