<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::index');
