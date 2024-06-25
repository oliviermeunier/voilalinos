<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('api', ['namespace' => 'App\User\UI\Controller'],  static function($routes) {
    $routes->post('users', 'UserController::create');
    $routes->put('users/(:segment)', 'UserController::update/$1');
});

$routes->group('api/private', ['namespace' => 'App\User\UI\Controller'], static function($routes) {
    $routes->get('users', 'UserController::list');
    $routes->put('users/(:segment)', 'UserController::update/$1');
    $routes->delete('users/(:segment)', 'UserController::delete/$1');
});

