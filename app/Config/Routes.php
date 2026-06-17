<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'CaisseController::index');
$routes->post('/caisse/choisir', 'CaisseController::choisir');
$routes->get('/achat', 'AchatController::index');
// $routes->post('/achat/ajouter', 'AchatController::ajouterLigne');
// $routes->get('/achat/cloturer', 'AchatController::cloturer');