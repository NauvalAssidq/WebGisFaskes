<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Main routes
$routes->get('/', 'Main::index');
$routes->get('/map', 'Main::map');
$routes->get('/daftar-faskes', 'Main::daftarFaskes');
$routes->get('/tentang', 'Main::tentang');

// API endpoints untuk peta
$routes->get('/map/getMarkers', 'Map::getMarkers');
$routes->get('/map/getAmenitiesList', 'Map::getAmenitiesList');
$routes->get('/map/getAmenitiesList', 'Map::searchFilteredAmenities');

// Authentication
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');

$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');

$routes->post('/login/logout', 'Login::logout');

// Dashboard
$routes->get('dashboard', 'Dashboard::index');
$routes->get('/dashboard/map', 'Dashboard::map');

// API endpoints untuk peta di dashboard
$routes->get('dashboard/map/getMarkers', 'MapDashboard::getMarkers');
$routes->get('dashboard/map/getAmenitiesList', 'MapDashboard::getAmenitiesList');


