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

        if (!$caisse) {
            return redirect()->back()->with('error', 'Caisse introuvable.');
        }

        session()->set('caisse', [
            'id'      => $caisse['id'],
            'numero'  => $caisse['numero'],
            'libelle' => $caisse['libelle'],
        ]);

        return redirect()->to('/achat');  // ✅ route correcte
    }
}