<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProduitModel;
use App\Models\AchatModel;

class AchatController extends BaseController
{
    public function index()
    {
        // Vérifier qu'une caisse est bien choisie en session
        if (!session('caisse')) {
            return redirect()->to('/')->with('error', 'Veuillez choisir une caisse d\'abord.');
        }

        $produitModel = new ProduitModel();
        $achatModel   = new AchatModel();

        $caisseId = session('caisse')['id'];

        // Récupérer ou créer l'achat en cours (et mettre à jour la session)
        $achat = $achatModel->getAchatEnCours($caisseId);
        session()->set('achat_id', $achat['id']);

        // Récupérer les lignes de l'achat en cours avec jointure sur produit
        $lignes = $achatModel->getLignes($achat['id']);

        return view('achat/index', [
            'produits' => $produitModel->findAll(),
            'lignes'   => $lignes,
        ]);
    }

    public function ajouterLigne()
    {
        if (!session('caisse')) {
            return redirect()->to('/')->with('error', 'Veuillez choisir une caisse d\'abord.');
        }

        $produitId = $this->request->getPost('produit_id');
        $quantite  = (int) $this->request->getPost('quantite');

        if (!$produitId || $quantite < 1) {
            return redirect()->back()->with('error', 'Produit ou quantité invalide.');
        }

        $produitModel = new ProduitModel();
        $achatModel   = new AchatModel();

        $produit  = $produitModel->find($produitId);
        $caisseId = session('caisse')['id'];

        // Utiliser l'achat_id en session (créé au moment du choix de caisse)
        $achat = $achatModel->getAchatEnCours($caisseId);

        $achatModel->ajouterLigne(
            $achat['id'],
            $produit['id'],
            $quantite,
            $produit['prix']
        );

        return redirect()->to('/achat')->with('success', 'Produit ajouté.');
    }

    public function cloturer()
    {
        if (!session('caisse')) {
            return redirect()->to('/');
        }

        $achatModel = new AchatModel();
        $caisseId   = session('caisse')['id'];
        $achat      = $achatModel->getAchatEnCours($caisseId);

        // Clôturer l'achat en cours
        $achatModel->cloturerAchat($achat['id']);

        // ✅ Créer automatiquement un nouvel achat pour le prochain client
        $nouvelAchat = $achatModel->getAchatEnCours($caisseId);
        session()->set('achat_id', $nouvelAchat['id']);

        return redirect()->to('/achat')->with('success', 'Achat clôturé. Nouveau client prêt.');
    }

    public function liste()
    {
        $achatModel = new AchatModel();
        $filtre     = $this->request->getGet('statut'); // 'en_cours' | 'cloture' | null

        $achats = $achatModel->getListeAchats($filtre);

        return view('achat/liste', [
            'achats' => $achats,
            'filtre' => $filtre,
        ]);
    }
}