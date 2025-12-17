<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

$routes->get('/inicio', 'Inicio::index');

// Rutas de Productos
$routes->get('/productos', 'Productos::index');
$routes->post('/productos/guardar', 'Productos::guardar');
$routes->get('/productos/eliminar/(:num)', 'Productos::eliminar/$1');

// Rutas de Clientes
$routes->get('/clientes', 'Clientes::index');
$routes->post('/clientes/guardar', 'Clientes::guardar');
$routes->get('/clientes/eliminar/(:num)', 'Clientes::eliminar/$1');

// Rutas de Ventas
$routes->get('/ventas', 'Ventas::index');
$routes->post('/ventas/guardar', 'Ventas::guardar');

// Rutas de Reportes
$routes->get('/reportes', 'Reportes::index');
$routes->get('/reportes/excel', 'Reportes::excel');
$routes->get('/reportes/pdf', 'Reportes::pdf');