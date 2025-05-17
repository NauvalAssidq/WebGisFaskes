<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/map', 'Map::index');
$routes->get('/map/getMarkers', 'Map::getMarkers');
$routes->get('/map/getAmenitiesList', 'Map::getAmenitiesList');
