<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/etudiant', 'Etudiant::index');

$routes->get('/etudiant/(:num)', 'Etudiant::show/$1');

$routes->resource('api/etudiant');