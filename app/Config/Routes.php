<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'WebGis::home');
$routes->get('/about', 'WebGis::about');
$routes->get('/test', 'Home::test');
$routes->get('/maps', 'WebGis::maps');
