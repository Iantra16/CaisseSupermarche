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

        // Récupérer ou créer l'achat en cours
        $achat = $achatModel->getAchatEnCours($caisseId);

        // Récupérer les lignes de l'achat en cours
        $lignes = $achatModel->getLignes($achat['id']);

        return view('caisse/achat', [
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
        $achat    = $achatModel->getAchatEnCours($caisseId);

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

        $achatModel->cloturerAchat($achat['id']);

        return redirect()->to('/achat')->with('success', 'Achat clôturé avec succès.');
    }
}