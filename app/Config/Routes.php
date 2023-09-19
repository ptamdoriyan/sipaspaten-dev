<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth');
$routes->get('logout', 'Auth::logout');
$routes->post('login', 'Auth::login');
$routes->get('user', 'User');
$routes->get('user/view', 'User::view');
$routes->get('user/add', 'User::addData');
$routes->post('user/add', 'User::addData');
$routes->get('profile', 'Profile');
$routes->put('profile/editpassword', 'Profile::editPassword');
$routes->put('profile/editprofile', 'Profile::editProfile');
$routes->get('file/(:num)', 'User::Download/$1');
$routes->get('file/(:num)/(:num)/delete', 'User::delete/$1/$2');


//bhp
$routes->get('bhp', 'Bhp');
