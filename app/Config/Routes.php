<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth');
$routes->post('login', 'Auth::login');
$routes->get('user', 'User');
$routes->get('user/add', 'User::addData');
$routes->post('user/add', 'User::addData');
$routes->get('file/(:num)', 'User::Download/$1');
