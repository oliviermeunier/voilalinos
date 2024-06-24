<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('api', static function($routes) {
    $routes->post('users', 'UserController::create');
    $routes->put('users/(:segment)', 'UserController::update/$1');
});

$routes->group('api/private', static function($routes) {
    $routes->get('users', 'UserController::list');
    $routes->put('users/(:segment)', 'UserController::update/$1');
    $routes->delete('users/(:segment)', 'UserController::delete/$1');
});

