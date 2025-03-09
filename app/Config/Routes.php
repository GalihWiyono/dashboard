<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::showLoginPage');
$routes->get('/register', 'AuthController::showRegisterPage');

$routes->post('/login', 'AuthController::loginAccount');
$routes->post('/register', 'AuthController::registerAccount');

$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/users', 'UsersController::index');
$routes->get('/users/get/(:num)', 'UsersController::getUserById/$1');
$routes->post('/users/update/(:num)', 'UsersController::updateUser/$1');
$routes->post('/users/delete/(:num)', 'UsersController::deleteUser/$1');

$routes->get('/pending-users', 'UsersController::pendingUsers');
$routes->post('/users/approve/(:num)', 'UsersController::approveUser/$1');
$routes->post('/users/reject/(:num)', 'UsersController::rejectUser/$1');