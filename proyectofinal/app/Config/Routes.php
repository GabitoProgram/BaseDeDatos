<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/*
$routes->get('pacientes','Pacientes::index');
$routes->get('pacientes/new','Pacientes::new');
*/

/*
$routes->get('doctores','doctores::index');
$routes->get('doctores/new','doctores::new');
*/



/*
$routes->get('citas','citas::index');
$routes->get('citas/new','citas::new');
*/

/*
$routes->get('recordatorios','recordatorios::index');
$routes->get('recordatorios/new','recordatorios::new');
*/

$routes->resource('pacientes', ['placeholder' => '(:num)', 'except' => 'show']);
$routes->resource('doctores', ['placeholder' => '(:num)', 'except' => 'show']);
$routes->resource('citas', ['placeholder' => '(:num)', 'except' => 'show']);
$routes->resource('recordatorios', ['placeholder' => '(:num)', 'except' => 'show']);


$routes->get('pacientes', 'Pacientes::index');
$routes->get('pacientes/nuevo', 'Pacientes::new');
$routes->post('pacientes', 'Pacientes::create');
$routes->get('pacientes/(:num)/editar', 'Pacientes::edit/$1');
$routes->post('pacientes/(:num)', 'Pacientes::update/$1');
$routes->delete('pacientes/(:num)', 'Pacientes::delete/$1');


$routes->get('doctores', 'Doctores::index');
$routes->get('doctores/nuevo', 'Doctores::new');
$routes->post('doctores', 'Doctores::create');
$routes->get('doctores/(:num)/editar', 'Doctores::edit/$1');
$routes->post('doctores/(:num)', 'Doctores::update/$1');
$routes->delete('doctores/(:num)', 'Doctores::delete/$1');

$routes->get('citas', 'Citas::index');
$routes->get('citas/nuevo', 'Citas::new');
$routes->post('citas', 'Citas::create');
$routes->get('citas/(:num)/editar', 'Citas::edit/$1');
$routes->post('citas/(:num)', 'Citas::update/$1');
$routes->delete('citas/(:num)', 'Citas::delete/$1');

$routes->get('recordatorios', 'Recordatorios::index');
$routes->get('recordatorios/nuevo', 'Recordatorios::new');
$routes->post('recordatorios', 'Recordatorios::create');
$routes->get('recordatorios/(:num)/editar', 'Recordatorios::edit/$1');
$routes->post('recordatorios/(:num)', 'Recordatorios::update/$1');
$routes->delete('recordatorios/(:num)', 'Recordatorios::delete/$1');

