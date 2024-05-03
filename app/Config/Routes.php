<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');

// ADMIN
$routes->group('admin', function (RouteCollection $routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('logout', 'Admin\Dashboard::logout');
});
