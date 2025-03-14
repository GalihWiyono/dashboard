<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('/', 'AuthController::showLoginPage');
    $routes->get('register', 'AuthController::showRegisterPage');
    $routes->post('register', 'AuthController::registerAccount');
    $routes->post('login', 'AuthController::loginAccount');
});

$routes->get('logout', 'AuthController::logoutAccount', ['filter' => 'auth']);


$routes->group('issue', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'IssuesController::index');
    $routes->get('get/(:num)', 'IssuesController::getIssue/$1');
    $routes->get('detail/(:num)', 'IssuesController::showDetailIssue/$1');
    $routes->get('export', 'IssuesController::exportIssues', ['filter' => 'auth:Admin']);

    $routes->get('edit/(:num)', 'IssuesController::showEditIssue/$1');
    $routes->post('edit/(:num)/save', 'IssuesController::saveEditIssue/$1');

    $routes->get('create', 'IssuesController::showAddIssue', ['filter' => 'auth:User']);
    $routes->post('store', 'IssuesController::saveIssue', ['filter' => 'auth:User']);

    $routes->group('(:num)/comments', function ($routes) {
        $routes->get('', 'CommentsController::getCommentByIssueId/$1');
        $routes->post('', 'CommentsController::addCommentByIssueId/$1', ['filter' => 'auth:Admin']);
    });
});

$routes->group('comment', ['filter' => 'auth:Admin'], function ($routes) {
    $routes->post('update/(:num)', 'CommentsController::updateCommentById/$1');
    $routes->post('delete/(:num)', 'CommentsController::deleteCommentById/$1');
});

$routes->group('dashboard', ['filter' => 'auth:Admin'], function ($routes) {
    $routes->get('', 'DashboardController::index');
});

$routes->group('users', ['filter' => 'auth:Admin'], function ($routes) {
    $routes->get('', 'UsersController::index');
    $routes->get('get/(:num)', 'UsersController::getUserById/$1');
    $routes->post('update/(:num)', 'UsersController::updateUser/$1');
    $routes->post('delete/(:num)', 'UsersController::deleteUser/$1');

    $routes->get('pending', 'UsersController::pendingUsers');
    $routes->post('approve/(:num)', 'UsersController::approveUser/$1');
    $routes->post('reject/(:num)', 'UsersController::rejectUser/$1');
});
