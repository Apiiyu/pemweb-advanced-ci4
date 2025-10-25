<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/**
 * @description Admin Section
 */
$routes->group('admin', function($routes){
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
