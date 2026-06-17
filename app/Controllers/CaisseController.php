<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CaisseModel;

class CaisseController extends BaseController
{
    public function index()
    {
        $caisseModel = new CaisseModel();
        $caisses = $caisseModel->getAllCaisses();
        return view('caisse/choix', ['caisses' => $caisses]);
    }

    public function choisir()
    {
        $caisseId = $this->request->getPost('caisse_id');

        if (!$caisseId) {
            return redirect()->back()->with('error', 'Veuillez sélectionner une caisse.');
        }
        $caisseModel = new CaisseModel();
        $caisse = $caisseModel->getCaisseById($caisseId);
        session()->set('caisse_choisit', $caisse);

        return view('caisse/accueil', ['caisse' => $caisse]);
    }
}