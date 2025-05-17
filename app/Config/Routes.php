<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Main::index');
$routes->get('/map', 'Main::peta');
$routes->get('/daftar-faskes', 'Main::daftarFaskes');
$routes->get('/tentang', 'Main::tentang');

// API endpoints untuk peta
$routes->get('/map/getMarkers', 'Map::getMarkers');
$routes->get('/map/getAmenitiesList', 'Map::getAmenitiesList');

//Authentication
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');

$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');

$routes->post('/login/logout', 'Login::logout');

//Dashboard
$routes->get('dashboard', 'Dashboard::index');

