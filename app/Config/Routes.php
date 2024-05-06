<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');

// ADMIN
$routes->group('admin', ['filter' => 'admin'], function (RouteCollection $routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->post('logout', 'Admin\Dashboard::logout');

    // User
    $routes->group('user', function (RouteCollection $routes) {
        $routes->get('/', 'Admin\User::index');
        $routes->get('create', 'Admin\User::create');
        $routes->post('store', 'Admin\User::store');
        $routes->get('edit/(:num)', 'Admin\User::edit/$1');
        $routes->post('update/(:num)', 'Admin\User::update/$1');
        $routes->get('delete/(:num)', 'Admin\User::delete/$1');
    });

    // Patient
    $routes->group('patient', function (RouteCollection $routes) {
        $routes->get('/', 'Admin\Patient::index');
        $routes->get('show/(:num)', 'Admin\Patient::show/$1');
        $routes->get('create', 'Admin\Patient::create');
        $routes->post('store', 'Admin\Patient::store');
        $routes->get('edit/(:num)', 'Admin\Patient::edit/$1');
        $routes->post('update/(:num)', 'Admin\Patient::update/$1');
        $routes->get('delete/(:num)', 'Admin\Patient::delete/$1');
        $routes->post('import', 'Admin\Patient::import');
    });

    // Cases
    $routes->group('cases', function (RouteCollection $routes) {
        $routes->get('/', 'Admin\Cases::index');
        $routes->get('create', 'Admin\Cases::create');
        $routes->post('store', 'Admin\Cases::store');
        $routes->get('edit/(:num)', 'Admin\Cases::edit/$1');
        $routes->post('update/(:num)', 'Admin\Cases::update/$1');
        $routes->get('delete/(:num)', 'Admin\Cases::delete/$1');
    });

    // Retention Schedule
    $routes->group('retention-schedule', function (RouteCollection $routes) {
        $routes->get('/', 'Admin\RetentionSchedule::index');
        $routes->get('create', 'Admin\RetentionSchedule::create');
        $routes->post('store', 'Admin\RetentionSchedule::store');
        $routes->get('edit/(:num)', 'Admin\RetentionSchedule::edit/$1');
        $routes->post('update/(:num)', 'Admin\RetentionSchedule::update/$1');
        $routes->get('delete/(:num)', 'Admin\RetentionSchedule::delete/$1');
    });
});
