<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table      = 'utilisateur';
    protected $primaryKey = 'id';
    protected $allowedFields = ['login', 'password', 'role'];
    protected $useTimestamps = false;

    public function verifier(string $login, string $password): array|false
    {
        $user = $this->where('login', $login)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}