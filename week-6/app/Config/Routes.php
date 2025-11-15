<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/**
 * @description Authentication Routes
 */
$routes->group('auth', function($routes) {
    // Login
    $routes->get('login', 'Auth::login');
    $routes->post('attempt-login', 'Auth::attemptLogin');
    
    // Register
    $routes->get('register', 'Auth::register');
    $routes->post('attempt-register', 'Auth::attemptRegister');
    
    // Forgot Password
    $routes->get('forgot-password', 'Auth::forgotPassword');
    $routes->post('process-forgot-password', 'Auth::processForgotPassword');
    
    // Reset Password
    $routes->get('reset-password/(:any)', 'Auth::resetPassword/$1');
    $routes->post('process-reset-password', 'Auth::processResetPassword');
    
    // Logout
    $routes->get('logout', 'Auth::logout');
});

/**
 * @description Admin Section (Protected by Auth Filter)
 */
$routes->group('admin', ['filter' => 'auth'], function($routes){
	$routes->get('news', 'NewsAdmin::index');
	$routes->get('news/(:segment)/preview', 'NewsAdmin::preview/$1');
    $routes->add('news/new', 'NewsAdmin::create');
	$routes->add('news/(:segment)/edit', 'NewsAdmin::edit/$1');
	$routes->get('news/(:segment)/delete', 'NewsAdmin::delete/$1');
});

/**
 * @description News Section
 */
$routes->get('/news', 'News::index');
$routes->get('/news/(:any)', 'News::viewNews/$1');
