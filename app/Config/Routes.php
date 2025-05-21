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
$routes->get('/map/getDistricts', 'Map::getDistricts');
$routes->get('/map/getHospitalTypes', 'Map::getHospitalTypes');
$routes->get('/map/getClasses', 'Map::getClasses');


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
$routes->group('dashboard/map', function($routes) {
    $routes->get('/', 'MapDashboard::index');
    $routes->get('getMarkers', 'MapDashboard::getMarkers');
    $routes->get('getAmenitiesList', 'MapDashboard::getAmenitiesList');
    $routes->get('getDistricts', 'MapDashboard::getDistricts');
    $routes->get('getHospitalTypes', 'MapDashboard::getHospitalTypes');
    $routes->get('getClasses', 'MapDashboard::getClasses');
});


// Dashboard list faskes
$routes->get('dashboard/puskesmas',    'HealthFacilityController::listPuskesmas');
$routes->get('dashboard/rumahsakit',   'HealthFacilityController::listRumahSakit');
$routes->get('dashboard/klinik',       'HealthFacilityController::listKlinik');

// Dashboard edit faskes
$routes->match(
    ['GET', 'POST'],'dashboard/edit/(:num)','HealthFacilityController::edit/$1'
);

// Dashboard delete faskes
$routes->post('dashboard/delete/(:num)', 'HealthFacilityController::delete/$1');
