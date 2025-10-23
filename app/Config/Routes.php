<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function ($routes) {
  // These handle preflight OPTIONS requests
  $routes->options('products', function () {
    return true;
  });
  $routes->options('products/(:any)', function () {
    return true;
  });

  // Your RESTful routes
  $routes->resource('products');
});
