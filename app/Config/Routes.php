<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth');
$routes->post('login', 'Auth::login');
$routes->get('user', 'User');
$routes->get('file/(:num)', 'BePutusan::Download/$1');
