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

