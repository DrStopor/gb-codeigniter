<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MessagesController::partList/3/id/asc');
$routes->get('/(:alpha)/(:alpha)', 'MessagesController::partList/3/$1/$2');
$routes->get('/message/delete/(:num)', 'MessagesController::delete/$1');
$routes->post('/message/create', 'MessagesController::create');
