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

    // Liste tous les achats avec infos caisse + total + nb lignes
    public function getListeAchats($statut = null)
    {
        $builder = $this->db->table('achat a')
            ->select([
                'a.id',
                'a.statut',
                'a.date_achat',
                'c.libelle AS caisse_libelle',
                'COUNT(al.id)   AS nb_lignes',
                'COALESCE(SUM(al.montant), 0) AS total',
            ])
            ->join('caisse c', 'c.id = a.caisse_id', 'left')
            ->join('achat_ligne al', 'al.achat_id = a.id', 'left')
            ->groupBy('a.id')
            ->orderBy('a.id', 'DESC');

        if ($statut) {
            $builder->where('a.statut', $statut);
        }

        return $builder->get()->getResultArray();
    }
}