<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/old-results', 'Home::old_results');

service('auth')->routes($routes);

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'login']);