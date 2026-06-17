<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProduitModel;

class ProduitController extends BaseController
{
    public function index()
    {
        $produitModel = new ProduitModel();
        return view('produit/index', [
            'produits' => $produitModel->findAll(),
        ]);
    }

    public function store()
    {
        $produitModel = new ProduitModel();

        $designation = trim($this->request->getPost('designation'));
        $prix        = (float) $this->request->getPost('prix');
        $stock       = (int)   $this->request->getPost('quantite_stock');

        if (!$designation || $prix <= 0) {
            return redirect()->back()->with('error', 'Données invalides.');
        }

        $produitModel->insert([
            'designation'    => $designation,
            'prix'           => $prix,
            'quantite_stock' => $stock,
        ]);

        return redirect()->to('/produits')->with('success', 'Produit ajouté avec succès.');
    }

    public function update($id)
    {
        $produitModel = new ProduitModel();

        $designation = trim($this->request->getPost('designation'));
        $prix        = (float) $this->request->getPost('prix');
        $stock       = (int)   $this->request->getPost('quantite_stock');

        if (!$designation || $prix <= 0) {
            return redirect()->back()->with('error', 'Données invalides.');
        }

        $produitModel->update($id, [
            'designation'    => $designation,
            'prix'           => $prix,
            'quantite_stock' => $stock,
        ]);

        return redirect()->to('/produits')->with('success', 'Produit mis à jour.');
    }

    public function delete($id)
    {
        $produitModel = new ProduitModel();
        $produitModel->delete($id);
        return redirect()->to('/produits')->with('success', 'Produit supprimé.');
    }
}
