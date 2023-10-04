<?php

use CodeIgniter\Commands\Utilities\Routes;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//auth
$routes->get('/', 'Auth');
$routes->get('logout', 'Auth::logout');
$routes->post('login', 'Auth::login');

//user
$routes->get('user', 'User');
$routes->get('user/view', 'User::view');
$routes->get('user/add', 'User::addData');
$routes->post('user/add', 'User::addData');
$routes->get('profile', 'Profile');
$routes->put('profile/editpassword', 'Profile::editPassword');
$routes->put('profile/editprofile', 'Profile::editProfile');
$routes->get('downloads/penetapan/(:num)', 'Files::getPenetapan/$1');
$routes->get('downloads/ba/(:num)', 'Files::getBeritaAcara/$1');

//files
$routes->get('filepenetapan/(:num)', 'Files::getPenetapan/$1');
$routes->get('filepenetapan/(:num)/(:num)/delete', 'Files::delPenetapan/$1/$2');
$routes->get('fileberita/(:num)', 'Files::getBerita/$1');
$routes->get('fileberita/(:num)/(:num)/delete', 'Files::delBerita/$1/$2');

//bhp
$routes->get('bhp', 'Bhp');
$routes->get('bhp/add/(:any)', 'Bhp::addData/$1');
$routes->get('bhp/view', 'Bhp::viewAllPa');
$routes->post('bhp/upload', 'Bhp::addBerita');

//pta
$routes->get('pta', 'Pta');
$routes->get('pta/view', 'Pta::viewAllPa');

//admin
$routes->get('admin', 'Admin');
$routes->get('admin/view', 'Admin::viewAllPa');
$routes->get('admin/user', 'Admin::user_view');
$routes->post('admin/reset', 'Admin::resetPassword');
$routes->post('admin/useroff', 'Admin::userOff');
$routes->post('admin/useron', 'Admin::userOn');
$routes->post('admin/adduser', 'Admin::addUser');
$routes->get('admin/user_detail/(:num)', 'Admin::userDetail/$1');
