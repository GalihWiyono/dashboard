<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::showLoginPage');
$routes->get('/register', 'AuthController::showRegisterPage');

$routes->post('/login', 'AuthController::loginAccount');
$routes->post('/register', 'AuthController::registerAccount');

// Halaman User (Untuk User dan Admin)
$routes->get('/issue', 'IssuesController::index', ['filter' => 'auth']);
$routes->get('/issue/get/(:num)', 'IssuesController::getIssue/$1');
$routes->get('/issue/detail/(:num)', 'IssuesController::showDetailIssue/$1', ['filter' => 'auth']);

$routes->get('/issue/edit/(:num)', 'IssuesController::showEditIssue/$1', ['filter' => 'auth']);
$routes->post('/issue/edit/(:num)/save', 'IssuesController::saveEditIssue/$1', ['filter' => 'auth']);

$routes->get('/issue/create', 'IssuesController::showAddIssue', ['filter' => 'auth:User']);
$routes->post('/issue/store', 'IssuesController::saveIssue', ['filter' => 'auth:User']);


// Halaman Admin (Untuk Admin)
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth:Admin']);

$routes->get('/users', 'UsersController::index', ['filter' => 'auth:Admin']);
$routes->get('/users/get/(:num)', 'UsersController::getUserById/$1', ['filter' => 'auth:Admin']);
$routes->post('/users/update/(:num)', 'UsersController::updateUser/$1', ['filter' => 'auth:Admin']);
$routes->post('/users/delete/(:num)', 'UsersController::deleteUser/$1', ['filter' => 'auth:Admin']);

$routes->get('/pending-users', 'UsersController::pendingUsers', ['filter' => 'auth:Admin']);
$routes->post('/users/approve/(:num)', 'UsersController::approveUser/$1', ['filter' => 'auth:Admin']);
$routes->post('/users/reject/(:num)', 'UsersController::rejectUser/$1', ['filter' => 'auth:Admin']);