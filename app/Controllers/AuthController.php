<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Si déjà connecté, rediriger
        if (session()->get('utilisateur')) {
            return redirect()->to('/caisse');
        }
        return view('auth/login');
    }

    public function doLogin()
    {
        $login    = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $model = new UtilisateurModel();
        $user  = $model->verifier($login, $password);

        if (!$user) {
            return redirect()->to('/login')->with('erreur', 'Identifiants incorrects');
        }

        session()->set('utilisateur', [
            'id'    => $user['id'],
            'login' => $user['login'],
            'role'  => $user['role'],
        ]);

        return redirect()->to('/caisse');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
