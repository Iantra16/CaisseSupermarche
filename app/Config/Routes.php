<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
<<<<<<< Updated upstream
// Routes publiques
$routes->get('/login',  'AuthController::login');
$routes->post('/login', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');

// Routes protégées
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'CaisseController::index');
    $routes->get('/caisse', 'CaisseController::index');
    $routes->post('/caisse/choisir', 'CaisseController::choisir');
    $routes->get('/achat', 'AchatController::index');
    $routes->post('/achat/ajouter', 'AchatController::ajouterLigne');
    $routes->get('/achat/cloturer', 'AchatController::cloturer');
});
=======

// Caisse
$routes->get('/', 'CaisseController::index');
$routes->post('/caisse/choisir', 'CaisseController::choisir');

// Achat - saisie
$routes->get('/achat', 'AchatController::index');
$routes->post('/achat/ajouter', 'AchatController::ajouterLigne');
$routes->get('/achat/cloturer', 'AchatController::cloturer');

// Achats - liste historique
$routes->get('/achats', 'AchatController::liste');

// Produits - CRUD
$routes->get('/produits', 'ProduitController::index');
$routes->post('/produits/creer', 'ProduitController::store');
$routes->post('/produits/modifier/(:num)', 'ProduitController::update/$1');
$routes->get('/produits/supprimer/(:num)', 'ProduitController::delete/$1');
>>>>>>> Stashed changes
