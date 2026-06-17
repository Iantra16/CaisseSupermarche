<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
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