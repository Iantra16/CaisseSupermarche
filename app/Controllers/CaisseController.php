<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CongeModel;

class CaisseController extends BaseController
{
    public function index()
    {
        return view('caisse/choix');
    }

    public function choisir()
    {
        $caisseId = $this->request->getPost('caisse_id');

        // Vérifiez si l'ID de la caisse est valide
        if (!$caisseId) {
            return redirect()->back()->with('error', 'Veuillez sélectionner une caisse.');
        }

        // Stockez l'ID de la caisse dans la session
        session()->set('caisse_id', $caisseId);

        // Redirigez vers la page d'accueil ou une autre page appropriée
        return redirect()->to('/')->with('success', 'Caisse sélectionnée avec succès.');
    }
}