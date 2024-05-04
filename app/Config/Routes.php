<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');

// ADMIN
$routes->group('admin', ['filter' => 'admin'], function (RouteCollection $routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->post('logout', 'Admin\Dashboard::logout');

    // Patient
    $routes->group('patient', function (RouteCollection $routes) {
        $routes->get('/', 'Admin\Patient::index');
        $routes->get('create', 'Admin\Patient::create');
        $routes->post('store', 'Admin\Patient::store');
        $routes->get('edit/(:num)', 'Admin\Patient::edit/$1');
        $routes->post('update/(:num)', 'Admin\Patient::update/$1');
        $routes->get('delete/(:num)', 'Admin\Patient::delete/$1');
    });
});
