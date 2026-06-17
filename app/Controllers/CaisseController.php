<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CaisseModel;
use App\Models\AchatModel;

class CaisseController extends BaseController
{
    public function index()
    {
        // Libérer la caisse en cours quand on revient à l'accueil
        session()->remove(['caisse', 'achat_id']);

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

        // Enregistrer la caisse en session
        session()->set('caisse', [
            'id'      => $caisse['id'],
            'numero'  => $caisse['numero'],
            'libelle' => $caisse['libelle'],
        ]);

        // ✅ Créer (ou récupérer) l'achat en cours dès le choix de caisse
        $achatModel = new AchatModel();
        $achat = $achatModel->getAchatEnCours($caisse['id']);

        // Stocker l'achat_id en session
        session()->set('achat_id', $achat['id']);

        return redirect()->to('/achat')->with('success', 'Caisse ' . esc($caisse['libelle']) . ' sélectionnée.');
    }
}