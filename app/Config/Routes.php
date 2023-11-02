<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'MessagesController::partList');
$routes->get('/message/(:num)', 'MessagesController::show/$1');
$routes->post('/message/delete/(:num)', 'MessagesController::delete/$1');
$routes->post('/message/edit/(:num)', 'MessagesController::edit/$1');
$routes->post('/message/create', 'MessagesController::create');

$routes->get('/users', 'UsersController::index');
$routes->post('/user/delete/(:num)', 'UsersController::delete/$1');
$routes->post('/user/edit/(:num)', 'UsersController::edit/$1');
$routes->post('/user/add', 'UsersController::add');

$routes->get('/roles', 'RolesController::index');
$routes->post('/role/delete/(:num)', 'RolesController::delete/$1');
$routes->post('/role/edit/(:num)', 'RolesController::edit/$1');
$routes->post('/role/add', 'RolesController::add');
