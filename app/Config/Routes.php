<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/old-results', 'Home::old_results');

$routes->group('admin', function ($routes) {

    // Load all other Shield routes
    service('auth')->routes($routes);

    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'login']);
    $routes->get('admin-dashboard', 'Dashboard::admin_dashboard',['filter' => 'login']);
    $routes->get('add-result', 'Dashboard::add_result', ['filter' => 'login']);

});